<x-page title="BelongsToMany" :sectionMenu="[
    'Разделы' => [
        ['url' => '#pivot', 'label' => 'Pivot'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#values-query', 'label' => 'Query for values'],
        ['url' => '#tree', 'label' => 'Tree'],
        ['url' => '#onlycount', 'label' => 'onlyCount'],
    ]
]">

<x-p>The relationship field in laravel like belongsToMany</x-p>

<x-p>Displayed as a group of checkboxes, it is also possible to transform the display into select multiple</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Social media', 'socials', 'name')
    ];
}
//...
</x-code>

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>To implement pivot fields, use the method <code>fields</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Social media', 'socials', 'name')
            ->fields([
                Text::make('Link', 'link'),
            ])
    ];
}
//...
</x-code>


<x-image src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>

<x-sub-title id="select">Select</x-sub-title>

<x-p>To transform the display into select, use the method <code>select</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Social media', 'socials', 'name')
            ->select()
    ];
}
//...
</x-code>


<x-image src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>

<x-sub-title id="values-query">Query for values</x-sub-title>

<x-p>
    Available for all fields with relations
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->valuesQuery(fn(Builder $query) => $query->where('active', true))
    ];
}
//...
</x-code>

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>Sometimes it makes sense to display checkboxes with a hierarchy, say for categories that have nesting, for this purpose there is a method <code>tree</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->tree('parent_id') // Contact field
    ];
}
//...
</x-code>

<x-sub-title id="onlycount">onlyCount</x-sub-title>

<x-p>By default the main page will display all the selected values separated by commas, but if you want to display only the number of selected values, you should use the <code>onlyCount</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->onlyCount()
    ];
}
//...
</x-code>

</x-page>



