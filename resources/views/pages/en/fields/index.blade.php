<x-page
    title="Basics"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#formatted', 'label' => 'Formatting a value'],
            ['url' => '#label', 'label' => 'Label'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#hint', 'label' => 'Clue'],
            ['url' => '#link', 'label' => 'Link'],
            ['url' => '#nullable', 'label' => 'Nullable'],
            ['url' => '#sortable', 'label' => 'Sorting'],
            ['url' => '#badge', 'label' => 'Badge'],
            ['url' => '#hide-show', 'label' => 'Display'],
            ['url' => '#show-when', 'label' => 'Dynamic display'],
            ['url' => '#custom-view', 'label' => 'Changing the display'],
            ['url' => '#when-unless', 'label' => 'Methods by condition'],
            ['url' => '#fill', 'label' => 'Filling'],
            ['url' => '#apply', 'label' => 'Apply'],
            ['url' => '#events', 'label' => 'Events'],
            ['url' => '#assets', 'label' => 'Assets'],
            ['url' => '#wrapper', 'label' => 'Wrapper'],
            ['url' => '#reactive', 'label' => 'Reactive'],
            ['url' => '#on-change', 'label' => 'onChange methods'],
            ['url' => '#scheme', 'label' => 'Scheme field\'s work'],
        ]
    ]"
>

<x-p>
    Fields play a vital role in the <strong>MoonShine</strong> admin panel.<br />
    They are used in <code>FormBuilder</code> to build forms, in <code>TableBuilder</code> to create tables,
    as well as in forming a filter for <code>ModelResource</code>.
    They can be used in your custom pages and even outside the admin panel.<br />
    Fields in <strong>MoonShine</strong> are not tied to the model (except Slug field, ModelRelationFields, Json in asRelation mode),
    therefore, the range of their applications is limited only by your imagination.<br />
</x-p>
<x-p>
    For convenience, fields have <em>fluent interface</em>.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    To create an instance of a field, use static method <code>make()</code>.
</x-p>

<x-code language="php">
    Text::make(Closure|string|null $label = null, ?string $column = null, ?Closure $formatted = null)
</x-code>

<x-ul>
    <li><code>$label</code> - label, field title,</li>
    <li><code>$column</code> - a field in the database (for example name) or a relation (for example countries),</li>
    <li><code>$formatted</code> - closure for formatting the field value during preview (everywhere except the form).</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you do not specify <code>$column</code>,
    then the field in the database will be determined automatically based on <code>$label</code>.
</x-moonshine::alert>

<x-sub-title id="formatted">Value formatting</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make(
            'Name',
            'first_name',
            fn($item) => $item->first_name . ' ' . $item->last_name // [tl! focus]
        )
    ];
}

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Fields that do not support <em>formatted</em>: <code>Json</code>, <code>File</code>, <code>Range</code>,
    <code>RangeSlider</code>, <code>DateRange</code>, <code>Select</code>, <code>Enum</code>, <code>HasOne</code>,
    <code>HasMany</code>.
</x-moonshine::alert>

<x-sub-title id="label">Label</x-sub-title>

<x-p>
    If you need to change the <em>Label</em>, you can use the <code>setLabel()</code> method
</x-p>

<x-code language="php">
setLabel(Closure|string $label)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->setLabel(
                fn(Field $field) => $field->getData()?->exists
                    ? 'Slug (do not change)'
                    : 'Slug'
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    To translate <em>Label</em> you need to pass the translation key as the name and
    add <code>translatable()</code> method
</x-p>

<x-code language="php">
translatable(string $key = '')
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')->translatable('ui') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>or</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('ui.Title')->translatable() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    Basic html attributes such as <code>required</code>,
    <code>disabled</code> and <code>readonly</code>, must be specified by the appropriate methods on the field.
</x-p>

<x-code language="php">
disabled(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hidden(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
required(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->disabled() // [tl! focus]
            ->hidden() // [tl! focus]
            ->readonly() // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    The ability to specify any other attributes using the <code>custom Attributes()</code> method.
</x-p>

<x-code language="php">
customAttributes(array $attributes)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customAttributes(['autocomplete' => 'off']) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Method <code>customWrapperAttributes()</code> allows you to add attributes for a <em>wrapper</em> field.
</x-p>

<x-code language="php">
customWrapperAttributes(array $attributes)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customWrapperAttributes(['class' => 'mt-8']) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="hint">Clue</x-sub-title>

<x-p>
    You can add a hint with a description to a field by calling method <code>hint()</code>
</x-p>

<x-code language="php">
hint(string $hint)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->hint('From 0 to 5') // [tl! focus]
            ->min(0)
            ->max(5)
            ->stars()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/hint.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/hint_dark.png') }}"></x-image>

<x-sub-title id="link">Link</x-sub-title>

<x-p>
    You can add a link to the field (for example, with instructions)
    <code>link()</code>.
</x-p>

<x-code language="php">
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false
)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Link')
            ->link('https://cutcode.dev', 'CutCode', blank: true) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/link_dark.png') }}"></x-image>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    If you need to keep NULL for a field by default, you must use method <code>nullable()</code>.
</x-p>

<x-code language="php">
nullable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="sortable">Sorting</x-sub-title>

<x-p>
    To be able to sort a field on the main resource page, you need to add method <code>sortable()</code>.
</x-p>

<x-code language="php">
sortable(Closure|string|null $callback = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->sortable() // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Method <code>sortable()</code> can take the name of a field in the database or a closure as a parameter.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        BelongsTo::make('Author')->sortable('author_id'), // [tl! focus]

        Text::make('Title')->sortable(function (Builder $query, string $column, string $direction) {
            $query->orderBy($column, $direction);
        }) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    To display a field in preview mode as a <em>badge</em>,
    you need to use the <code>badge()</code> method.
</x-p>

<x-code language="php">
badge(string|Closure|null $color = null)
</x-code>

@include('pages.en.ui.shared.colors')

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->badge(fn($status, Field $field) => 'green') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="hide-show">Display</x-sub-title>

<x-p>
    In a model resource, fields are displayed on the list page (main page)
    and on the create/edit/view pages.<br />
    To exclude the display of a field on any page, you can use the appropriate methods
    <code>hideOnIndex()</code>, <code>hideOnForm()</code>, <code>hideOnDetail()</code> or
    reverse methods <code>showOnIndex()</code>, <code>showOnForm()</code>, <code>showOnDetail()</code>.<br />
    To exclude only from the edit or add page -
    <code>hideOnCreate()</code>, <code>hideOnUpdate()</code>,
    as well as reverse <code>showOnCreate()</code>, <code>showOnUpdate</code>
</x-p>

<x-code language="php">
hideOnIndex(Closure|bool|null $condition = null)
showOnIndex(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hideOnForm(Closure|bool|null $condition = null)
showOnForm(Closure|bool|null $condition = null)

hideOnCreate(Closure|bool|null $condition = null)
showOnCreate(Closure|bool|null $condition = null)

hideOnUpdate(Closure|bool|null $condition = null)
showOnUpdate(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hideOnDetail(Closure|bool|null $condition = null)
showOnDetail(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title') // [tl! focus:start]
            ->hideOnIndex()
            ->hideOnForm(), // [tl! focus:end]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    If you just need to specify which fields to display on pages or change the order of display,
    then you can use a convenient method
    <x-link :link="to_page('resources-fields') . '#override'" >
        field overrides
    </x-link>.
</x-moonshine::alert>

<x-sub-title id="show-when">Dynamic display</x-sub-title>

<x-p>
    It may be necessary to display a field only if the value of another field in the form has a certain value
    (for example: display the phone only if there is a checkmark that there is a phone).<br />
    Method <code>showWhen()</code> is used for this purpose.
</x-p>

<x-code language="php">
showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
</x-code>

<x-p>
    Available operators:
</x-p>

<x-p>
    <x-moonshine::badge color="gray">=</x-moonshine::badge>
    <x-moonshine::badge color="gray"><</x-moonshine::badge>
    <x-moonshine::badge color="gray">></x-moonshine::badge>
    <x-moonshine::badge color="gray"><=</x-moonshine::badge>
    <x-moonshine::badge color="gray">>=</x-moonshine::badge>
    <x-moonshine::badge color="gray">!=</x-moonshine::badge>
    <x-moonshine::badge color="gray">in</x-moonshine::badge>
    <x-moonshine::badge color="gray">not in</x-moonshine::badge>
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    If operator is not specified, <code>=</code> will be used
</x-moonshine::alert>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Checkbox::make('Has phone', 'has_phone'),
        Phone::make('Phone')
            ->showWhen('has_phone','=', 1) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the operator is <code>in</code> or <code>not in</code>,
    then in <code>$value</code> you need to pass an array
</x-moonshine::alert>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Select::make('List', 'list')->multiple()->options([
            'value 1' => 'Option Label 1',
            'value 2' => 'Option Label 2',
            'value 3' => 'Option Label 3',
        ]),

        Text::make('Name')
            ->showWhen('list', 'not in', ['value 1', 'value 3']), // [tl! focus]

        Textarea::make('Content')
            ->showWhen('list', 'in', ['value 2', 'value 3']) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    In the <code>showWhen()</code> method for the <em>Json</em> and <em>BelongsToMany</em> fields
    You can access nested values via <code>.</code>:
</x-p>

<x-code language="php">
    ->showWhen('data.content.active', '=', 1)
</x-code>

<x-sub-title id="custom-view">Changing the display</x-sub-title>

<x-p>
    When you need to change the view using <em>fluent interface</em>
    you can use the <code>customView()</code> method.
</x-p>

<x-code language="php">
customView(string $customView)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->customView('fields.my-custom-input') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Method <code>changePreview()</code> allows you to override the view for the preview (everywhere except the form).
</x-p>

<x-code language="php">
changePreview(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->changePreview(function ($value, Field $field) {
                return view('moonshine::ui.image', [
                    'value' => Storage::url($value)
                ]);
            }) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    The <code>forcePreview()</code> method will indicate that the field should always be in preview mode
</x-p>

<x-code language="php">
    Text::make('Label')->forcePreview()
</x-code>

<x-p>
    The <code>requestValueResolver()</code> method allows you to override the logic for getting a value from Request
</x-p>

<x-code language="php">
requestValueResolver(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->requestValueResolver(function (string $nameDot, mixed $default, Field $field) {
                return request($nameDot, $default);
            }) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    <code>beforeRender()</code> and <code>afterRender()</code> methods
    allows you to display some information before and after the field, respectively.
</x-p>

<x-code language="php">
beforeRender(Closure $closure)
</x-code>

<x-code language="php">
afterRender(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Image::make('Thumbnail')
            ->beforeRender(function (Field $field) {
                return $field->preview();
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="when-unless">Methods by condition</x-sub-title>

<x-p>
    Method <code>when()</code> implements a <em>fluent interface</em>
    and exucutes callback when the first argument passed to the method is true.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(fn($field) => $field->getData()?->exists, fn(Field $field) => $field->locked()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    An instance of the field will be passed to the callback function.
</x-moonshine::alert>

<x-p>
    The second callback can be passed to method <code>when()</code>, it will be executed,
    when the first argument passed to the method is false.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(
                fn($field) => $field->getData()?->exists,
                fn(Field $field) => $field->locked(),
                fn(Field $field) => $field->hidden()
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    Method <code>unless()</code> is the inverse of method <code>when()</code> and will execute the first callback,
    when the first argument is false, otherwise the second callback will be executed if it is passed to the method.
</x-p>

<x-code language="php">
unless($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->unless(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->readonly()->hideOnCreate(),
                fn(Field $field) => $field->locked()
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-sub-title id="fill">Filling</x-sub-title>

<x-p>
    Fields can be filled with values using the <code>fill()</code> method.
</x-p>

<x-code language="php">
fill(mixed $value, mixed $casted = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->fill('Some title') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    The <code>changeFill()</code> method allows you to change the logic of filling a field with values.
</x-p>

<x-code language="php">
fill(mixed $value, mixed $casted = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Categories')
            ->changeFill(
                fn(Article $data, Field $field) => $data->categories->implode('title', ',')
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Relationship fields do not support the <code>changeFill</code> method
</x-moonshine::alert>

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    Each field has an <code>apply()</code> method,
    which transforms the data taking into account the <em>request</em> and <em>resolve</em> methods.
    For example, it transforms model data for saving in a database or generates a query for filtering.
</x-p>

<x-p>
    It is possible to override the actions when executing the <code>apply()</code> method,
    To do this, you need to use the <code>onApply()</code> method, which accepts a closure.
</x-p>

<x-code language="php">
onApply(Closure $onApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail by link', 'thumbnail')
            ->onApply(function(Model $item, $value, Field $field) {
                $path = 'thumbnail.jpg';

                if ($value) {
                    $item->thumbnail = Storage::put($path, file_get_content($value));
                }

                return $item;
            }) // [tl! focus:-8]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    If the field is used to build a filter, then a <em>Query Builder</em> will be passed to the closure.
</x-moonshine::alert>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]

//...

public function filters(): array
{
    return [
        Switcher::make('Active')
            ->onApply(fn(Builder $query, $value, Field $field) => $query->where('active', $value)) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    If you do not want the field to perform any actions,
    then you can use the <code>canApply()</code> method.
</x-p>

<x-code language="php">
canApply(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->canApply() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="events">Events</x-sub-title>

<x-p>
    Sometimes you may need to override <em>resolve</em> methods that are executed before and after <code>apply()</code>,
    to do this, you must use appropriate methods.
</x-p>

<x-code language="php">
onBeforeApply(Closure $onBeforeApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onBeforeApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-code language="php">
onAfterApply(Closure $onAfterApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-code language="php">
onAfterDestroy(Closure $onAfterDestroy)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterDestroy(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-sub-title id="assets">Assets</x-sub-title>

<x-p>
    For the field, it is possible to load additional CSS styles and JS scripts using the <code>addAssets()</code> method.
</x-p>

<x-code language="php">
addAssets(array $assets)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->addAssets(['custom.css', 'custom.js']) // [tl! focus]
    ];
}
</x-code>

<x-sub-title id="wrapper">Wrapper</x-sub-title>

<x-p>
    When displayed on forms, fields use a special <em>wrapper</em> for titles, tooltips, links, etc.
    Sometimes a situation may arise when you want to display a field without additional elements.<br />
    Method <code>withoutWrapper()</code> allows you to disable the creation of <em>wrapper</em>.
</x-p>

<x-code language="php">
withoutWrapper(mixed $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->withoutWrapper() // [tl! focus]
    ];
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/without_wrapper.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/without_wrapper_dark.png') }}"></x-image>

<x-sub-title id="reactive">Reactive</x-sub-title>

<x-p>
    The <code>reactive()</code> method allows you to change fields reactively.
</x-p>

<x-code language="php">
reactive(
    ?Closure $callback = null,
    bool $lazy = false,
    int $debounce = 0,
    int $throttle = 0,
)
</x-code>

<x-ul>
    <li><code>$callback</code> - <em>callback</em> function,</li>
    <li><code>$lazy</code> - deferred function call</li>
    <li><code>$debounce</code> - time between function calls (ms.),</li>
    <li><code>$throttle</code> - function call interval (ms.).</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Fields that support reactivity: <code>Text</code>, <code>Checkbox</code>, <code>Select</code>
    and their successors.
</x-moonshine::alert>

<x-code language="php">
FormBuilder::make()
    ->name('my-form')
    ->fields([
        Text::make('Title')
            ->reactive(function(Fields $fields, ?string $value): Fields {
                return tap($fields, static fn ($fields) => $fields
                    ->findByColumn('slug')
                    ?->setValue(str($value ?? '')->slug()->value())
                );
            }),

        Text::make('Slug')->reactive(),
    ])
</x-code>

<x-p>
    This example implements the formation of a slug field based on the header.<br/>
    The Slug will be generated as you enter text.
</x-p>

<x-sub-title id="on-change">onChange methods</x-sub-title>

<x-p>
    Using the <code>onChangeMethod()</code> and <code>onChangeUrl()</code> methods
    You can add logic when changing field values.
</x-p>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The <code>onChangeUrl()</code> or <code>onChangeMethod()</code> methods are present for all fields,
    except for the <em>HasOne</em> and <em>HasMany</em> relationship fields.
</x-moonshine::alert>

<x-moonshine::divider label="onChangeUrl()" />

<x-p>
    The <code>onChangeUrl()</code> method allows you to send a request asynchronously when a field changes.
</x-p>

<x-code language="php">
onChangeUrl(
    Closure $url,
    string $method = 'PUT',
    array $events = [],
    ?string $selector = null,
    ?string $callback = null,
)
</x-code>

<x-ul>
    <li><code>$url</code> - request url</li>
    <li><code>$method</code> - asynchronous request method</li>
    <li><code>$events</code> - events to be called after a successful request,</li>
    <li><code>$selector</code> - selector of the element whose content will change</li>
    <li><code>$callback</code> - js callback function after receiving a response.</li>
</x-ul>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl('/endpoint') // [tl! focus]
    ];
}
</x-code>

<x-p>
    If you need to replace the area with html after a successful request,
    you can return HTML content or json with the html key in the response.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl('/endpoint', selector: '#my-selector') // [tl! focus]
    ];
}
</x-code>

<x-moonshine::divider label="onChangeMethod()" />

<x-p>
    The <code>onChangeMethod()</code> method allows you to asynchronously call a resource or page method when a field changes
    without the need to create additional controllers.
</x-p>

<x-code language="php">
onChangeMethod(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    ?string $callback = null,
    ?Page $page = null,
    ?ResourceContract $resource = null,
)
</x-code>

<x-ul>
    <li><code>$method</code> - name of the method</li>
    <li><code>$params</code> - parameters for the request,</li>
    <li><code>$message</code> - messages</li>
    <li><code>$selector</code> - selector of the element whose content will change</li>
    <li><code>$events</code> - events to be called after a successful request,</li>
    <li><code>$callback</code> - js callback function after receiving a response</li>
    <li><code>$page</code> - page containing the method</li>
    <li><code>$resource</code> - resource containing the method.</li>
</x-ul>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeMethod('someMethod') // [tl! focus]
    ];
}
</x-code>

<x-code language="php">
public function someMethod(MoonShineRequest $request): void
{
    // Logic
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Example of sorting the <em>CardsBuilder</em> component in the section
    <x-link link="{{ to_page('recipes') }}#sorting-for-cards-builder">Recipes</x-link>
</x-moonshine::alert>

<x-sub-title id="scheme">Scheme field's work</x-sub-title>

<x-link link="{{ asset('files/field_scheme.pdf') }}" target="_blank">
    <x-image src="{{ asset('screenshots/field_scheme.png') }}"></x-image>
</x-link>

</x-page>
