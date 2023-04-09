<x-page title="BelongsToMany" :sectionMenu="[
    'Разделы' => [
        ['url' => '#pivot', 'label' => 'Pivot'],
        ['url' => '#only-selected', 'label' => 'Поиск значений'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#values-query', 'label' => 'Запрос для значений'],
        ['url' => '#tree', 'label' => 'Tree'],
        ['url' => '#onlycount', 'label' => 'onlyCount'],
    ]
]">

<x-p>Поле для отношений в laravel типа belongsToMany</x-p>

<x-p>Отображается как группа чекбоксов, также есть возможность трансформировать отображение в select multiple</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_dark.png') }}"></x-image>

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>Для реализации pivot полей, воспользуйтесь методом <code>fields</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', 'contacts', 'name')
            ->fields([
                Text::make('Contact', 'text'),
            ])
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_pivot_dark.png') }}"></x-image>

<x-sub-title id="only-selected">Поиск значений</x-sub-title>

<x-p>Для реализации поиска значений, воспользуйтесь методом <code>onlySelected</code></x-p>

<x-p>Параметр <code>searchQuery</code> используется для фильтрации значений,
    а <code>searchValueCallback</code> для кастомизации вывода</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Contacts')
            ->onlySelected(
                'users',
                'title',
                searchQuery: function (Builder $query) {
                    return $query->where('id', '!=', 2);
                },
                searchValueCallback: function ($contact) {
                    return $contact->id . ' | ' . $contact->title;
                }
            )
            ->fields([
                Text::make('Contact', 'text'),
            ])
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_select_pivot.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_select_pivot_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Запросы необходимо кастомизировать через метод <code>onlySelected</code>,
    не используйте <code>valuesQuery</code>!
</x-moonshine::alert>

<x-sub-title id="select">Select</x-sub-title>

<x-p>Для трансформации отображения в select, воспользуйтесь методом <code>select</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->select()
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_select_dark.png') }}"></x-image>

<x-sub-title id="values-query">Запрос для значений</x-sub-title>

<x-p>
    Доступно для всех полей с отношениями
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Категории', 'categories', 'name')
            ->valuesQuery(fn(Builder $query) => $query->where('active', true))
    ];
}
//...
</x-code>

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>Иногда имеет смысл отобразить чекбоксы с иерархией, скажем для категорий,
    которые имеют вложенность, для таких целей есть метод <code>tree</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Категории', 'categories', 'name')
            ->tree('parent_id') // Поле для связи
    ];
}
//...
</x-code>

<x-sub-title id="onlycount">onlyCount</x-sub-title>

<x-p>По умолчанию на главной странице будут отображаться все выбранные значения через запятую,
    но если требуется отобразить только значение количества выбранных, то следует воспользоваться методом <code>onlyCount</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Категории', 'categories', 'name')
            ->onlyCount()
    ];
}
//...
</x-code>

</x-page>
