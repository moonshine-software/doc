<x-page title="Таблица" :sectionMenu="[
    'Разделы' => [
        ['url' => '#properties', 'label' => 'Свойства'],
        ['url' => '#buttons', 'label' => 'Кнопки'],
        ['url' => '#attributes', 'label' => 'Атрибуты'],
        ['url' => '#click', 'label' => 'Действия по клику'],
        ['url' => '#sticky-table', 'label' => 'Фиксированная шапка таблицы'],
        ['url' => '#simple-pagination', 'label' => 'Простая пагинация'],
        ['url' => '#disable-pagination', 'label' => 'Отключение пагинации'],
        ['url' => '#async', 'label' => 'Асинхронный режим'],
        ['url' => '#update-row', 'label' => 'Обновление ряда'],
        ['url' => '#column-display', 'label' => 'Отображение колонок'],
    ]
]">

<x-sub-title id="properties">Свойства</x-sub-title>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $sortColumn = ''; // Поле сортировки по умолчанию [tl! focus]

    protected string $sortDirection = 'DESC'; // Тип сортировки по умолчанию [tl! focus]

    protected int $itemsPerPage = 25; // Количество элементов на странице [tl! focus]

    //...
}
</x-code>

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Для добавления кнопок в таблицу используются ActionButton и методы <code>indexButtons</code> или <code>buttons</code> в ресурсе
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    <x-link link="{{ to_page('action_button') }}">Подробнее ActionButton</x-link>
</x-moonshine::alert>

<x-code>
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Пример создания кастомных кнопок у индексной таблицы в разделе
    <x-link link="{{ to_page('recipes') }}#custom-buttons">Recipes</x-link>
</x-moonshine::alert>

<x-p>
    Для массовых действий необходимо добавить метод <code>bulk</code>
</x-p>

<x-code>
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
</x-code>

<x-p>
    Также можно воспользоваться методом <code>buttons</code>, но в таком случае кнопки будут и на всех остальных страницах ресурса
</x-p>

<x-code>
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Через ресурсы модели есть возможность кастомизировать <code>tr</code> и <code>td</code> у таблицы с данными.<br />
    Для это необходимо использовать соответствующие методы <code>trAttributes()</code> и <code>tdAttributes()</code>,
    которым нужно передать замыкание, возвращающее атрибуты для компонента таблица.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use Closure;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function trAttributes(): Closure // [tl! focus:start]
    {
        return function (
            Model $item,
            int $row,
            ComponentAttributeBag $attr
        ): ComponentAttributeBag {
            if ($item->id === 1 | $row === 2) {
                $attr->setAttributes([
                    'class' => 'bgc-green'
                ]);
            }

            return $attr;
        };
    } // [tl! focus:end]

    public function tdAttributes(): Closure // [tl! focus:start]
    {
        return function (
            Model $item,
            int $row,
            int $cell,
            ComponentAttributeBag $attr = null
        ): ComponentAttributeBag {
            if ($cell === 6) {
                $attr->setAttributes([
                    'class' => 'bgc-red'
                ]);
            }

            return $attr;
        };
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/table_class.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/table_class_dark.png') }}"></x-image>

<x-sub-title id="click">Действия по клику</x-sub-title>

<x-p>
    По умолчанию на клик по tr ничего не произойдет, но можно изменить поведение на
    переход в редактирование, выбор или переход к детальному просмотру
</x-p>

<x-code>
    // Свойство ресурса
    // ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

    protected ?ClickAction $clickAction = ClickAction::SELECT;
</x-code>

<x-sub-title id="sticky-table">Фиксированная шапка таблицы</x-sub-title>

<x-p>
    Свойство ресурса модели <code>stickyTable</code> позволяет зафиксировать шапку
    при прокрутке таблицы с большим числом элементов.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $stickyTable = true; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="simple-pagination">Простая пагинация</x-sub-title>

<x-p>
    Если вы не планируете отображать общее количество страниц, воспользуйтесь <code>Simple Pagination</code>.
    Это позволит избежать дополнительных запросов на общее количество записей в базе данных.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $simplePaginate = true; // [tl! focus]

    // ...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_simple_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_simple_paginate_dark.png') }}"></x-image>

<x-sub-title id="disable-pagination">Отключение пагинации</x-sub-title>

<x-p>
    Если вы не планируете использовать разбиение на страницы, то его можно отключить.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $usePagination = false; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Переключить режим без перезагрузки для фильтрации, сортировки и пагинации
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="update-row">Обновление ряда</x-sub-title>

<x-p>
    У таблицы можно асинхронно обновить ряд, для этого необходимо вызвать событие:
</x-p>

<x-code>
table-row-updated-@{{componentName}}-@{{row-key}}
</x-code>

<x-ul>
    <li><code>@{{componentName}}</code> - название компонента;</li>
    <li><code>@{{row-key}}</code> - ключ ряда.</li>
</x-ul>

<x-p>
    Для добавления события можно воспользоваться классом-помощником:
</x-p>

<x-code>
    AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'main-table-{row-id}')
</x-code>

<x-ul>
    <li><code>{row-id}</code> - shortcode для id текущей записи модели.</li>
</x-ul>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Наличие поля ID и асинхронный режим является обязательными.
</x-moonshine::alert>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\ID;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Support\AlpineJs;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    //...

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
            Textarea::make('Body'),
            Switcher::make('Active')
                ->updateOnPreview(
                    events: [AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'index-table-{row-id}')] // [tl! focus]
                )
        ];
    }

    //...
}
</x-code>

<x-p>
    Также доступен метод <code>withUpdateRow()</code>, который помогает упростить назначение событий:
</x-p>

<x-code>
TableBuilder::make()
    ->fields([
        ID::make()->sortable(),
        Text::make('Title'),
        Textarea::make('Body'),
        Switcher::make('Active')
            ->withUpdateRow('main-table') // [tl! focus]
    ])
    ->items($this->fetch())
    ->name('main-table')
    ->async(),
</x-code>

<x-sub-title id="column-display">Отображение колонок</x-sub-title>

<x-p>
    Можно предоставить пользователям самостоятельно определять какие колонки отображать в таблице,
    с сохранением выбора. Для этого необходимо у ресурса задать параметр <code>$columnSelection</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true; // [tl! focus]

    //...
}
</x-code>

<x-p>
    Если необходимо исключить поля из выбора, то воспользуйтесь методом <code>columnSelection()</code>.
</x-p>

<x-code language="php">
public function columnSelection(bool $active = true)
</x-code>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true;

    //...

    public function fields(): array
    {
        return [
            ID::make()
                ->columnSelection(false), // [tl! focus]
            Text::make('Title'),
            Textarea::make('Body'),
        ];
    }

    //...
}
</x-code>

</x-page>
