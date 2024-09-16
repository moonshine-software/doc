https://moonshine-laravel.com/docs/resource/models-resources/resources-import_export?change-moonshine-locale=en

------
# Import / Export
 
- [Basics](#basics)
- [Import](#import)
- [Export](#export)
- [Handler methods](#methods)
- [Custom implementation](#custom)

<a name="basics"></a>
## Basics

By default, import and export are enabled for all model resources.  
To override this behavior, you need to change the `moonshine` configuration.

```php
// config/moonshine.php

'model_resources' => [
    'default_with_import' => false,
    'default_with_export' => false,
],
```

You can also disable import and export in a resource; for this, the corresponding methods must return `null`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    public function import(): ?ImportHandler
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return null;
    }

    //...
}
```

<a name="import"></a>
## Import

You can import data into the **MoonShine** admin panel.

#### Fields

The fields that will participate in the import are required in the model resource, add `useOnImport()` method.

```php
useOnImport(mixed $condition = null, ?Closure $fromRaw = null)
```

- `$condition` - method execution condition,
- `$fromRaw` - a closure that returns values from the raw.

```php
namespace App\MoonShine\Resources;

use App\Enums\StatusEnum;
use App\Models\Post;
use MoonShine\Fields\Enum;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array
    {
        return [
            ID::make()
                ->useOnImport(),

            Enum::make('Status')
                ->attach(StatusEnum::class)
                ->useOnImport(fromRaw: static fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw)),
        ];
    }

    //...
}
```

> [!NOTE]
> Be sure to add ID to the import, otherwise, records will only be added without updating existing ones.

#### Handler

It is also necessary to implement the `import()` method in the model resource. The method must return an *ImportHandler* object that implements the data import algorithm.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function import(): ?ImportHandler
    {
        return ImportHandler::make('Import');
    }

    //...
}
```

#### Methods ImportHandler

Optional methods are available to configure import:

```php
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        // Specify the ID of the users who will receive a notification about the end of the operation
        ->notifyUsers(fn() => [auth()->id()])
        // Disc selection
        ->disk('public')
        // Selecting a directory to save the import file
        ->dir('/imports')
        // Delete file after import
        ->deleteAfter()
        // Separator for csv
        ->delimiter(',');
}

//...
```

If the `import()` method returns *NULL*, then the import button will not appear on the index page.

#### Events

To change the import logic, you can use [events](https://moonshine-laravel.com/docs/resource/models-resources/resources-events) of the model resource.

```php
//  MoonShine\Resources\ModelResource

public function beforeImportFilling(array $data): array
{
    return $data;
}

public function beforeImported(Model $item): Model
{
    return $item;
}

public function afterImported(Model $item): Model
{
    return $item;
}
```

These events are called in `ImportHandler`

```php
// MoonShine\Handlers\ImportHandler

$data = $resource->beforeImportFilling($data);

$item->forceFill($data);

$item = $resource->beforeImported($item);

return tap(
    $item->save(),
    fn() => $resource->afterImported($item)
);
```

<a name="export"></a>
## Export

In the **MoonShine** admin panel you can export all data taking into account the current filtering and sorting.

> [!NOTE]
> By default, data is exported in `xlsx` format, but there is an option to change the format to `csv` globally or through the `csv()` method of the class `ExportHandler`.

#### Global export format

You can change the export format globally in `MoonShineServiceProvider`:

```php
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\ModelResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        ModelResource::defaultExportToCsv();
    }
}
```

#### Fields

Only those fields that have the `showOnExport()` method added will participate in the export.

```php
showOnExport(mixed $condition = null, ?Closure $modifyRawValue = null)
```

- `$condition` - method execution condition,
- `$modifyRawValue` - closure to get the raw value.

```php
namespace App\MoonShine\Resources;

use App\Enums\StatusEnum;
use App\Models\Post;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array
    {
        return [
            Text::make('Title', 'title')
                ->showOnExport(),

            Enum::make('Status')
                ->attach(StatusEnum::class)
                ->showOnExport(modifyRawValue: static fn(StatusEnum $raw, Enum $ctx) => $raw->value),
        ];
    }

    //...
}
```

#### Handler

It is also necessary to implement the `export()` method in the model resource. The method must return an _ExportHandler_ object that implements the data export algorithm.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function export(): ?ExportHandler
    {
        return ExportHandler::make('Export');
    }

    //...
}
```

#### Methods ExportHandler

Optional methods are available to configure export:

```php
use MoonShine\Handlers\ExportHandler;

//...

public function export(): ?ExportHandler
{
    return ExportHandler::make('Export')
        // Specify the ID of the users who will receive a notification about the end of the operation
        ->notifyUsers(fn() => [auth()->id()])
        // Disc selection
        ->disk('public')
        // File name
        ->filename(sprintf('export_%s', date('Ymd-His')))
        // Selecting the directory for saving the export file
        ->dir('/exports')
        // If you need to export in csv format
        ->csv()
        // Separator for csv
        ->delimiter(',')
        // Export with confirmation
        ->withConfirm();
}

//...
```
> [!NOTE]
> If the `export()` method returns _NULL_, then the export button will not appear on the index page.

<a name="methods"></a>
## Handler methods

*ImportHandler* and *ExportHandler* extend the base class *Handler* that implements additional methods.

#### icon

```php
// icon for button
icon(string $icon)
```

#### queue

```php
// run processes in the background
queue()
```

#### when

```
// conditional methods
when($value = null, callable $callback = null, callable $default = null)
```

`$value` - condition,  
`$callback` - callback function that will be executed if the condition is true _TRUE_,  
`$default` - callback function that will be executed if the condition is true _FALSE_.

```php
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        ->when(
            true,
            fn($handler) => $handler->delimiter(','),
            fn($handler) => $handler->delimiter(';')
        );
}

//...
```

#### unless

```php
// conditional methods
unless($value = null, callable $callback = null, callable $default = null)
```

`$value` - condition,  
`$callback` - callback function that will be executed if the condition is true _FALSE_,  
`$default` - callback function that will be executed if the condition is true _TRUE_.

> [!NOTE]
> The `unless()` method is the `when()` method the inverse.

<a name="custom"></a>
## Custom implementation

There may be a situation where you want to change your import or export implementation. To do this, you need to implement your own class extending *ImportHandler* or *ExportHandler*.

The class can be generated using the console command:

```php
php artisan moonshine:handler
```

After executing the command, a base handler class will be created in the `app/MoonShine/Handlers` directory.
