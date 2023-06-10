<x-page title="BelongsToMany" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#pivot', 'label' => 'Pivot'],
        ['url' => '#async-search', 'label' => 'Асинхронный поиск'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#values-query', 'label' => 'Запрос для значений'],
        ['url' => '#tree', 'label' => 'Tree'],
        ['url' => '#onlycount', 'label' => 'onlyCount'],
    ]
]">

<x-extendby :href="route('moonshine.custom_page', 'fields-select')">
    Select
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>Поле для отношений в laravel типа <code>BelongsToMany</code>.</x-p>

<x-p>Отображается как группа чекбоксов, также есть возможность трансформировать отображение в select multiple.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany; // [tl! focus]

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name') // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_dark.png') }}"></x-image>

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>Для реализации pivot полей воспользуйтесь методом <code>fields()</code>.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', 'contacts', 'name')
            ->fields([
                Text::make('Contact', 'text'),
            ]) // [tl! focus:-2]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_pivot_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.async_search', ['field' => 'BelongsToMany'])

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Запросы необходимо кастомизировать через метод <code>asyncSearch()</code>,
    не используйте <code>valuesQuery()</code>!
</x-moonshine::alert>

<x-sub-title id="select">Select</x-sub-title>

<x-p>Для трансформации отображения в select воспользуйтесь методом <code>select()</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->select() // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_select_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.values_query', ['field' => 'BelongsToMany'])

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>
    Иногда имеет смысл отобразить чекбоксы с иерархией, например для категорий,
    которые имеют вложенность, для таких целей есть метод <code>tree()</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Категории', 'categories', 'name')
            ->tree('parent_id') // Поле для связи // [tl! focus]
    ];
}
//...
</x-code>

<x-sub-title id="onlycount">onlyCount</x-sub-title>

<x-p>
    По умолчанию на главной странице будут отображаться все выбранные значения через запятую,
    но если требуется отобразить только значение количества выбранных,
    то следует воспользоваться методом <code>onlyCount()</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Категории', 'categories', 'name')
            ->onlyCount() // [tl! focus]
    ];
}
//...
</x-code>

</x-page>
