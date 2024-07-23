<x-page
    title="BelongsToMany"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#label-column', 'label' => 'Column header'],
            ['url' => '#pivot', 'label' => 'Pivot'],
            ['url' => '#creatable', 'label' => 'Creating a Relationship Object'],
            ['url' => '#select', 'label' => 'Select'],
		    ['url' => '#options', 'label' => 'Options'],
            ['url' => '#placeholder', 'label' => 'Placeholder'],
            ['url' => '#tree', 'label' => 'Tree'],
            ['url' => '#preview', 'label' => 'Preview'],
            ['url' => '#only-link', 'label' => 'Link only'],
            ['url' => '#values-query', 'label' => 'Query for values'],
            ['url' => '#async-search', 'label' => 'Asynchronous search'],
		    ['url' => '#associated', 'label' => 'Related fields'],
            ['url' => '#with-image', 'label' => 'Values with picture'],
            ['url' => '#buttons', 'label' => 'Buttons'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

@include('pages.en.fields.shared.relation_make', ['field' => 'BelongsToMany', 'label' => 'Categories'])

<x-sub-title id="label-column">Column header</x-sub-title>

<x-p>
    By default, the table column header uses the property
    <code>$title</code> of the relationship model resource.<br />
    The <code>columnLabel()</code> method allows you to override the title.
</x-p>

<x-code language="php">
columnLabel(string $label)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->columnLabel('Title') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>
    The <code>fields()</code> method is used to implement <em>pivot</em> fields in the BelongsToMany relationship.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', resource: new ContactResource())
            ->fields([
                Text::make('Contact', 'text'),
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_pivot_dark.png') }}"></x-image>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The relationship must specify which <em>pivot</em> fields are used in the staging table!<br />
    More details in the official documentation
    <x-link
      link="https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns"
      target="_blank"
    >Laravel</x-link>.
</x-moonshine::alert>

<x-sub-title id="creatable">Creating a Relationship Object</x-sub-title>

@include('pages.en.fields.shared.relation_creatable', ['field' => 'BelongsToMany', 'label' => 'Categories'])

<x-sub-title id="select">Select</x-sub-title>

<x-p>
    The <em>BelongsToMany</em> field can be displayed as a drop-down list,
    To do this, you need to use the <code>selectMode()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->selectMode() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_select_dark.png') }}"></x-image>

@include('pages.en.fields.shared.choices_options', ['field' => 'BelongsToMany'])

@include('pages.en.fields.shared.placeholder', ['field' => 'BelongsToMany'])

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <code>placeholder()</code> method is only used
    if the field is displayed as a dropdown list <code>selectMode()</code>!
</x-moonshine::alert>

<x-sub-title id="tree">Tree</x-sub-title>

<x-p>
    The <code>tree()</code> method allows you to display values as a tree with checkboxes,
    for example, for categories that have nesting.
    The method must be passed a column in the database on which the tree will be built.
</x-p>

<x-code language="php">
tree(string $parentColumn)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->tree('parent_id') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_tree.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_tree_dark.png') }}"></x-image>

<x-sub-title id="preview">Preview</x-sub-title>

<x-p>
    By default, <em>preview</em> will display the field as a table.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_dark.png') }}"></x-image>

<x-p>
    To change the display in <em>preview</em> you can use the following methods.
</x-p>

<x-moonshine::divider label="onlyCount" />

<x-p>
    The <code>onlyCount()</code> method allows you to display only the number of selected values in <em>preview</em>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyCount() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview_count.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_count_dark.png') }}"></x-image>

<x-moonshine::divider label="inLine" />

<x-p>
    The <code>inLine()</code> method allows you to display field values as a line.
</x-p>

<x-code language="php">
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
</x-code>

<x-p>
    You can pass optional parameters to the method:
    <x-ul>
        <li><code>separator</code> - separator between elements;</li>
        <li><code>badge</code> - closure or boolean value, responsible for displaying elements as badge;</li>
        <li><code>$link</code> - a closure that should return <em>url</em> links or components.</li>
    </x-ul>
</x-p>
<x-p>
    When passing the boolean value true to the <code>badge</code> parameter, the color will be used <x-moonshine::badge color="primary">Primary</x-moonshine::badge>. To change the color displayed by <code>badge</code>, use closure and return the <code>Badge::make()</code> component.
</x-p>

<x-code language="php">
use MoonShine\Components\Link;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->inLine(
                separator: ' ',
                badge: fn($model, $value) => Badge::make($value, 'color'),
                link: fn(Category $category, $value, $field) => Link::make(
                    (new CategoryResource())->detailPageUrl($category),
                    $value
                )
            ) // [tl! focus:-7]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview_in_line.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_in_line_dark.png') }}"></x-image>

@include('pages.en.fields.shared.only_link', ['field' => 'BelongsToMany', 'label' => 'Categories'])

@include('pages.en.fields.shared.values_query', ['field' => 'BelongsToMany'])

@include('pages.en.fields.shared.async_search', ['field' => 'BelongsToMany'])

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Requests must be customized using the <code>asyncSearch()</code> method.
    Don't use <code>valuesQuery()</code>!
</x-moonshine::alert>

@include('pages.en.fields.shared.with_associated', ['field' => 'BelongsToMany'])

@include('pages.en.fields.shared.with_image', ['field' => 'BelongsToMany'])

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    The <code>buttons()</code> method allows you to add additional buttons to the <em>BelongsToMany</em> field.
</x-p>

<x-code language="php">
buttons(array $buttons)
</x-code>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->buttons([
                ActionButton::make('Check all', '')
                    ->onClick(fn() => 'checkAll', 'prevent'),

                ActionButton::make('Uncheck all', '')
                    ->onClick(fn() => '', 'prevent')
            ]) // [tl! focus:-6]
    ];
}

//...
</x-code>

<x-moonshine::divider label="withCheckAll" />

<x-p>
    The <code>withCheckAll()</code> method allows you to add checkAll/uncheckAll buttons to the <em>BelongsToMany</em> field
    similar to the previous example.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->withCheckAll() // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
