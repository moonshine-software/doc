<x-page
    title="Import / Export"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#import ', 'label' => 'Import'],
            ['url' => '#export', 'label' => 'Export'],
            ['url' => '#methods ', 'label' => 'Handler методы'],
            ['url' => '#custom', 'label' => 'Кастомная реализация'],
        ]
    ]"
>

<x-sub-title id="import">Import</x-sub-title>

<x-p>В админ-панель <strong>MoonShine</strong> можно импортировать данные.</x-p>

<x-moonshine::divider label="Поля" />

<x-p>
    Необходимо в ресурсе модели полям, которые будут участвовать в импорте,
    добавить метод <code>useOnImport()</code>.
</x-p>

<x-code language="php">
    useOnImport(mixed $condition = null)
</x-code>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array
    {
        return [
            ID::make()
                ->useOnImport(), // [tl! focus]

            Text::make('Title', 'title')
                ->useOnImport() // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Обязательно добавляйте в импорт ID, иначе записи будут только добавляться, без обновления существующих.
</x-moonshine::alert>

<x-moonshine::divider label="Handler" />

<x-p>
    Так же необходимо в ресурсе модели реализовать метод <code>import()</code>.
    Метод должен вернуть объект <em>ImportHandler</em>, реализующий алгоритм импорта данных.
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

<x-moonshine::divider label="Методы ImportHandler" />

<x-p>
    Для настройки импорта доступны опциональные методы:
</x-p>

<x-code language="php">
use MoonShine\Handlers\ImportHandler;

//...

public function import(): ?ImportHandler
{
    return ImportHandler::make('Import')
        // Выбор диска
        ->disk('public') // [tl! focus]
        // Выбор директории для сохранения файла импорта
        ->dir('/imports') // [tl! focus]
        // Удалять файл после импорта
        ->deleteAfter() // [tl! focus]
        // Разделитель для csv
        ->delimiter(','); // [tl! focus]
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод <code>import()</code> вернет <em>NULL</em>,
    то кнопка импорта не будет отображаться на индексной странице.
</x-moonshine::alert>

<x-sub-title id="export">Export</x-sub-title>

<x-p>
    В админ-панели <strong>MoonShine</strong> можно реализовать экспорт всех данных с учетом текущей фильтрации
    и сортировки.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    По умолчанию данные экспортируются в формате <code>xlsx</code>,
    но существует возможность экспортировать в формате <code>csv</code>.
</x-moonshine::alert>

<x-moonshine::divider label="Поля" />

<x-p>
    В экспорте будут участвовать только те поля у которых добавлен метод <code>showOnExport()</code>.
</x-p>

<x-code language="php">
    showOnExport(mixed $condition = null)
</x-code>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array
    {
        return [
            Text::make('Title', 'title')
                ->showOnExport() // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Handler" />

<x-p>
    Так же необходимо в ресурсе модели реализовать метод <code>export()</code>.
    Метод должен вернуть объект <em>ExportHandler</em>, реализующий алгоритм экспорта данных.
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

<x-moonshine::divider label="Методы ExportHandler" />

<x-p>
    Для настройки экспорта доступны опциональные методы:
</x-p>

<x-code language="php">
use MoonShine\Handlers\ExportHandler;

//...

public function export(): ?ExportHandler
{
    return ExportHandler::make('Export')
        // Выбор диска
        ->disk('public') // [tl! focus]
        // Выбор директории сохранения файла экспорта
        ->dir('/exports') // [tl! focus]
        // Если необходимо экспортировать в формате csv
        ->csv() // [tl! focus]
        // Разделитель для csv
        ->delimiter(','); // [tl! focus]
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод <code>export()</code> вернет <em>NULL</em>,
    то кнопка экспорта не будет отображаться на индексной странице.
</x-moonshine::alert>

<x-sub-title id="methods">Handler методы</x-sub-title>

<x-p>
    <em>ImportHandler</em> и <em>ExportHandler</em> расширяют базовый класс <em>Handler</em>
    который реализует дополнительные методы.
</x-p>

<x-moonshine::divider label="icon" />

<x-code language="php">
// иконка для кнопки
icon(string $icon)
</x-code>

<x-moonshine::divider label="queue" />

<x-code language="php">
// запускать процессы в фоне
queue()
</x-code>

<x-moonshine::divider label="when" />

<x-code language="php">
// методы по условию
when($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-p>
    <code>$value</code> - условие,<br>
    <code>$callback</code> - callback функция, которая будет выполнена, если условие имеет значение <em>TRUE</em>,<br>
    <code>$default</code> - callback функция, которая будет выполнена, если условие имеет значение <em>FALSE</em>.
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
// методы по условию
unless($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-p>
    <code>$value</code> - условие,<br>
    <code>$callback</code> - callback функция, которая будет выполнена, если условие имеет значение <em>FALSE</em>,<br>
    <code>$default</code> - callback функция, которая будет выполнена, если условие имеет значение <em>TRUE</em>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Метод <code>unless()</code> является обратным методу <code>when()</code>.
</x-moonshine::alert>


<x-sub-title id="custom">Кастомная реализация</x-sub-title>

<x-p>
    Может возникнуть ситуация, когда вы захотите изменить <em>ImportHandler</em> или <em>ExportHandler</em>.
    Для этого необходимо реализовать свой класс расширяющий базовый <em>Handler</em>.
</x-p>

<x-p>
    Класс можно сгенерировать, воспользовавшись консольной командой:
</x-p>

<x-code language="shell">
    php artisan moonshine:handler
</x-code>

<x-p>
    После выполнения команды будет создан базовый класс handler в директории <code>app/MoonShine/Handlers</code>.
</x-p>

</x-page>
