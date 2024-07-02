<x-page
    title="Import / Export"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#import ', 'label' => 'Import'],
            ['url' => '#export', 'label' => 'Export'],
            ['url' => '#methods ', 'label' => 'Handler methods'],
            ['url' => '#custom', 'label' => 'Custom implementation'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    By default, import and export are enabled for all model resources.<br />
    To override this behavior, you need to change the <code>moonshine</code> configuration.
</x-p>

<x-code language="php">
// config/moonshine.php

'model_resources' => [
    'default_with_import' => false,
    'default_with_export' => false,
],
</x-code>

<x-p>
    You can also disable import and export in a resource; for this, the corresponding methods must return <code>null</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    public function import(): ?ImportHandler // [tl! focus:start]
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return null;
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="import">Import</x-sub-title>

<x-p>You can import data into the <strong>MoonShine</strong> admin panel.</x-p>

<x-moonshine::divider label="Fields" />

<x-p>
    The fields that will participate in the import are required in the model resource,
    add <code>useOnImport()</code> method.
</x-p>

<x-code language="php">
useOnImport(mixed $condition = null, ?Closure $fromRaw = null)
</x-code>

<x-ul>
    <li><code>$condition</code> - method execution condition,</li>
    <li><code>$fromRaw</code> - a closure that returns values from the raw.</li>
</x-ul>

<x-code language="php">
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
                ->useOnImport(), // [tl! focus]

            Enum::make('Status')
                ->attach(StatusEnum::class)
                ->useOnImport(fromRaw: static fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw)), // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Be sure to add ID to the import, otherwise, records will only be added without updating existing ones.
</x-moonshine::alert>

<x-moonshine::divider label="Handler" />

<x-p>
    It is also necessary to implement the <code>import()</code> method in the model resource.
    The method must return an <em>ImportHandler</em> object that implements the data import algorithm.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Handlers\ImportHandler; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function import(): ?ImportHandler // [tl! focus:start]
    {
        return ImportHandler::make('Import');
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::divider label="Methods ImportHandler" />

<x-p>
    Optional methods are available to configure import:
</x-p>

<x-code language="php">
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        // Disc selection
        ->disk('public') // [tl! focus]
        // Selecting a directory to save the import file
        ->dir('/imports') // [tl! focus]
        // Delete file after import
        ->deleteAfter() // [tl! focus]
        // Separator for csv
        ->delimiter(','); // [tl! focus]
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the <code>import()</code> method returns <em>NULL</em>,
    then the import button will not appear on the index page.
</x-moonshine::alert>

<x-sub-title id="export">Export</x-sub-title>

<x-p>
    In the <strong>MoonShine</strong> admin panel you can export all data taking into account the current filtering
    and sorting.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    By default, data is exported in <code>xlsx</code> format,
    but there is an option to change the format to <code>csv</code> globally
    or through the <code>csv()</code> method of the class
    <code>ExportHandler</code>.
</x-moonshine::alert>

<x-moonshine::divider label="Global export format" />

<x-p>
    You can change the export format globally in <code>MoonShineServiceProvider</code>:
</x-p>

<x-code language="php">
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\ModelResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        ModelResource::defaultExportToCsv(); // [tl! focus]
    }
}
</x-code>

<x-moonshine::divider label="Fields" />

<x-p>
    Only those fields that have the <code>showOnExport()</code> method added will participate in the export.
</x-p>

<x-code language="php">
showOnExport(mixed $condition = null, ?Closure $modifyRawValue = null)
</x-code>

<x-ul>
    <li><code>$condition</code> - method execution condition,</li>
    <li><code>$modifyRawValue</code> - closure to get the raw value.</li>
</x-ul>

<x-code language="php">
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
                ->showOnExport(), // [tl! focus]

            Enum::make('Status')
                ->attach(StatusEnum::class)
                ->showOnExport(modifyRawValue: static fn(StatusEnum $raw, Enum $ctx) => $raw->value), // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Handler" />

<x-p>
    It is also necessary to implement the <code>export()</code> method in the model resource.
    The method must return an <em>ExportHandler</em> object that implements the data export algorithm.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Handlers\ExportHandler; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function export(): ?ExportHandler // [tl! focus:start]
    {
        return ExportHandler::make('Export');
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::divider label="Methods ExportHandler" />

<x-p>
    Optional methods are available to configure export:
</x-p>

<x-code language="php">
use MoonShine\Handlers\ExportHandler;

//...

public function export(): ?ExportHandler
{
    return ExportHandler::make('Export')
        // Disc selection
        ->disk('public') // [tl! focus]
        // File name
        ->filename(sprintf('export_%s', date('Ymd-His'))) // [tl! focus]
        // Selecting the directory for saving the export file
        ->dir('/exports') // [tl! focus]
        // If you need to export in csv format
        ->csv() // [tl! focus]
        // Separator for csv
        ->delimiter(','); // [tl! focus]
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the <code>export()</code> method returns <em>NULL</em>,
    then the export button will not appear on the index page.
</x-moonshine::alert>

<x-sub-title id="methods">Handler methods</x-sub-title>

<x-p>
    <em>ImportHandler</em> and <em>ExportHandler</em> extend the base class <em>Handler</em>
    that implements additional methods.
</x-p>

<x-moonshine::divider label="icon" />

<x-code language="php">
// icon for button
icon(string $icon)
</x-code>

<x-moonshine::divider label="queue" />

<x-code language="php">
// run processes in the background
queue()
</x-code>

<x-moonshine::divider label="when" />

<x-code language="php">
// conditional methods
when($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-p>
    <code>$value</code> - condition,<br>
    <code>$callback</code> - callback function that will be executed if the condition is true <em>TRUE</em>,<br>
    <code>$default</code> - callback function that will be executed if the condition is true <em>FALSE</em>.
</x-p>

<x-code language="php">
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        ->when(
            true,
            fn($handler) => $handler->delimiter(','),
            fn($handler) => $handler->delimiter(';')
        ); // [tl! focus:-4]
}

//...
</x-code>

<x-moonshine::divider label="unless" />

<x-code language="php">
// conditional methods
unless($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-p>
    <code>$value</code> - condition,<br>
    <code>$callback</code> - callback function that will be executed if the condition is true <em>FALSE</em>,<br>
    <code>$default</code> - callback function that will be executed if the condition is true <em>TRUE</em>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    The <code>unless()</code> method is the <code>when()</code> method the inverse.
</x-moonshine::alert>


<x-sub-title id="custom">Custom implementation</x-sub-title>

<x-p>
    There may be a situation where you want to change your import or export implementation.
    To do this, you need to implement your own class extending <em>ImportHandler</em> or <em>ExportHandler</em>.
</x-p>

<x-p>
    The class can be generated using the console command:
</x-p>

<x-code language="shell">
    php artisan moonshine:handler
</x-code>

<x-p>
    After executing the command, a base handler class will be created in the <code>app/MoonShine/Handlers</code> directory.
</x-p>

</x-page>
