# Импорт / Экспорт
 
- [Основы](#basics)
- [Импорт](#import)
- [Экспорт](#export)
- [Методы обработчиков](#methods)
- [Пользовательская реализация](#custom)

---

<a name="basics"></a>
## Основы

По умолчанию импорт и экспорт включены для всех ресурсов моделей.  
Чтобы переопределить это поведение, необходимо изменить конфигурацию `moonshine`.

```php
// config/moonshine.php

'model_resources' => [
    'default_with_import' => false,
    'default_with_export' => false,
],
```

Вы также можете отключить импорт и экспорт в ресурсе; для этого соответствующие методы должны возвращать `null`.

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
## Импорт

Вы можете импортировать данные в админ-панель **MoonShine**.

#### Поля

Поля, которые будут участвовать в импорте, необходимо в ресурсе модели добавить метод `useOnImport()`.

```php
useOnImport(mixed $condition = null, ?Closure $fromRaw = null)
```

- `$condition` - условие выполнения метода,
- `$fromRaw` - замыкание, возвращающее значения из сырых данных.

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
> Обязательно добавьте ID в импорт, иначе записи будут только добавляться без обновления существующих.

#### Обработчик

Также необходимо реализовать метод `import()` в ресурсе модели. Метод должен возвращать объект *ImportHandler*, который реализует алгоритм импорта данных.

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

#### Методы ImportHandler

Доступны необязательные методы для настройки импорта:

```php
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        // Указать ID пользователей, которые получат уведомление об окончании операции
        ->notifyUsers(fn() => [auth()->id()])
        // Выбор диска
        ->disk('public')
        // Выбор директории для сохранения файла импорта
        ->dir('/imports')
        // Удалить файл после импорта
        ->deleteAfter()
        // Разделитель для csv
        ->delimiter(',');
}

//...
```

Если метод `import()` возвращает *NULL*, то кнопка импорта не появится на странице индекса.

#### События

Для изменения логики импорта можно использовать [события](https://moonshine-laravel.com/docs/resource/models-resources/resources-events) ресурса модели.

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

Эти события вызываются в `ImportHandler`

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
## Экспорт

В админ-панели **MoonShine** вы можете экспортировать все данные с учетом текущей фильтрации и сортировки.

> [!NOTE]
> По умолчанию данные экспортируются в формате `xlsx`, но есть возможность изменить формат на `csv` глобально или через метод `csv()` класса `ExportHandler`.

#### Глобальный формат экспорта

Вы можете изменить формат экспорта глобально в `MoonShineServiceProvider`:

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

#### Поля

В экспорте будут участвовать только те поля, у которых добавлен метод `showOnExport()`.

```php
showOnExport(mixed $condition = null, ?Closure $modifyRawValue = null)
```

- `$condition` - условие выполнения метода,
- `$modifyRawValue` - замыкание для получения сырого значения.

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

#### Обработчик

Также необходимо реализовать метод `export()` в ресурсе модели. Метод должен возвращать объект _ExportHandler_, который реализует алгоритм экспорта данных.

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

#### Методы ExportHandler

Доступны необязательные методы для настройки экспорта:

```php
use MoonShine\Handlers\ExportHandler;

//...

public function export(): ?ExportHandler
{
    return ExportHandler::make('Export')
        // Указать ID пользователей, которые получат уведомление об окончании операции
        ->notifyUsers(fn() => [auth()->id()])
        // Выбор диска
        ->disk('public')
        // Имя файла
        ->filename(sprintf('export_%s', date('Ymd-His')))
        // Выбор директории для сохранения файла экспорта
        ->dir('/exports')
        // Если нужно экспортировать в формате csv
        ->csv()
        // Разделитель для csv
        ->delimiter(',')
        // Экспорт с подтверждением
        ->withConfirm();
}

//...
```
> [!NOTE]
> Если метод `export()` возвращает _NULL_, то кнопка экспорта не появится на странице индекса.

<a name="methods"></a>
## Методы обработчиков

*ImportHandler* и *ExportHandler* расширяют базовый класс *Handler*, который реализует дополнительные методы.

#### icon

```php
// иконка для кнопки
icon(string $icon)
```

#### queue

```php
// запуск процессов в фоновом режиме
queue()
```

#### when

```
// условные методы
when($value = null, callable $callback = null, callable $default = null)
```

`$value` - условие,  
`$callback` - функция обратного вызова, которая будет выполнена, если условие истинно _TRUE_,  
`$default` - функция обратного вызова, которая будет выполнена, если условие ложно _FALSE_.

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
// условные методы
unless($value = null, callable $callback = null, callable $default = null)
```

`$value` - условие,  
`$callback` - функция обратного вызова, которая будет выполнена, если условие ложно _FALSE_,  
`$default` - функция обратного вызова, которая будет выполнена, если условие истинно _TRUE_.

> [!NOTE]
> Метод `unless()` является обратным методу `when()`.

<a name="custom"></a>
## Пользовательская реализация

Может возникнуть ситуация, когда вы хотите изменить реализацию импорта или экспорта. Для этого необходимо реализовать собственный класс, расширяющий *ImportHandler* или *ExportHandler*.

Класс можно сгенерировать с помощью консольной команды:

```php
php artisan moonshine:handler
```

После выполнения команды в директории `app/MoonShine/Handlers` будет создан базовый класс обработчика.

