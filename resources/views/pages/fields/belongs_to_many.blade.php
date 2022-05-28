<x-page title="BelongsToMany" :sectionMenu="[
    'Разделы' => [
        ['url' => '#pivot', 'label' => 'Pivot'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#tree', 'label' => 'Tree'],
    ]
]">

<x-p>Поле для отношений в laravel типа belongsToMany</x-p>

<x-p>Отображается как группа чекбоксов, также есть возможность трансформировать отображение в select multiple</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Соц.сети', 'socials', 'name')
    ];
}
//...
</x-code>

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>Для реализации pivot полей, воспользуйтесь методом <code>fields</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Соц.сети', 'socials', 'name')
            ->fields([
                Text::make('Ссылка', 'link'),
            ])
    ];
}
//...
</x-code>


<x-image src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>

<x-sub-title id="select">Select</x-sub-title>

<x-p>Для трансформации отображения в select, воспользуйтесь методом <code>select</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Соц.сети', 'socials', 'name')
            ->select()
    ];
}
//...
</x-code>


<x-image src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>Иногда имеет смысл отобразить чекбоксы с иерархией, скажем для категорий,
    которые имеют вложенность, для таких целей есть метод <code>tree</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

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

<x-next href="{{ route('section', 'fields-has_many') }}">HasMany</x-next>

</x-page>



