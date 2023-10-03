<x-page title="BelongsToMany" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#pivot', 'label' => 'Pivot'],
		['url' => '#async-search', 'label' => 'Async search'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#values-query', 'label' => 'Values query'],
        ['url' => '#tree', 'label' => 'Tree'],
        ['url' => '#onlycount', 'label' => 'onlyCount'],
        ['url' => '#inline', 'label' => 'inLine'],
    ]
]">

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>Field for relationships in Laravel, <code>BelongsToMany</code> type.</x-p>

<x-p>Displayed as a group of checkboxes, you can also transform into select multiple.</x-p>

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

<x-p>To implement pivot fields, use the <code>fields()</code> method.</x-p>

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

@include('pages.en.fields.shared.async_search', ['field' => 'BelongsToMany'])

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Requests must be customized via the <code>asyncSearch()</code> method,
     don't use <code>valuesQuery()</code>!
</x-moonshine::alert>



<x-sub-title id="select">Select</x-sub-title>

<x-p>To transform the display into select, use the <code>select()</code> method.</x-p>

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

@include('pages.en.fields.shared.values_query', ['field' => 'BelongsToMany'])

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>
    Sometimes it makes sense to display checkboxes with a hierarchy, example for categories that have nesting,
    there is a <code>tree()</code> method for this.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->tree('parent_id') // Contact field // [tl! focus]
    ];
}
//...
</x-code>

<x-sub-title id="onlycount">onlyCount</x-sub-title>

<x-p>
    If you want to display only the number of selected values on the index page,
    then you should use the <code>onlyCount()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->onlyCount() // [tl! focus]
    ];
}
//...
</x-code>

<x-sub-title id="inline">inLine</x-sub-title>

<x-p>
    By default, the index page will display the field as a table,
    but if you want to display it in a line, you can use the <code>inLine()</code> method.
</x-p>
<x-p>
    Optional parameters can be passed to the method:
    <ul>
        <li><code>separator</code> - separator between elements</li>
        <li><code>badge</code> - display elements as badge</li>
    </ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsToMany;

//...
public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', 'name')
            ->inLine(separator: ' ', badge: true) // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_index_in_line.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_index_in_line_dark.png') }}"></x-image>

</x-page>
