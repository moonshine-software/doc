<x-page title="Basics" :sectionMenu="[
    'Sections' => [
        ['url' => '#make', 'label' => 'Make'],
        ['url' => '#hide-show', 'label' => 'Displaying'],
        ['url' => '#hide-show-conditions', 'label' => 'Conditional display'],
        ['url' => '#attributes', 'label' => 'Attributes'],
        ['url' => '#custom-attributes', 'label' => 'Arbitrary attributes'],
        ['url' => '#required', 'label' => 'Required field'],
        ['url' => '#dynamic', 'label' => 'Dynamic value'],
        ['url' => '#hint', 'label' => 'Hint'],
        ['url' => '#link', 'label' => 'Link'],
        ['url' => '#nullable', 'label' => 'Nullable'],
        ['url' => '#sortable', 'label' => 'Sorting'],
        ['url' => '#label', 'label' => 'Hide label'],
        ['url' => '#default', 'label' => 'Default value'],
        ['url' => '#show-when', 'label' => 'Display condition'],
        ['url' => '#can-save', 'label' => 'Ability to save'],
        ['url' => '#events', 'label' => 'Events'],
        ['url' => '#custom-view', 'label' => 'Change view'],
        ['url' => '#when-unless', 'label' => 'Methods by condition'],
    ]
]">

<x-p>
    Fields is one of the most important sections along with resources.
    We have already discussed the process of Fields registration in the Resource section,
    but let's figure out how to customize them to your needs! The fluent interface is used for convenience
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    First of all, let's understand how the <code>make</code> method works when creating an instance of a field
</x-p>

<x-code language="php">
Text::make(string $label = null, string $field = null, ResourceContract|string|null $resource = null)
</x-code>

<x-p>
    $label - Label, field header<br>
    $field - A field in the database (e.g. name) or a relation (e.g. countries)<br>
    $resource - In the case of $field The field must be specified in this parameter
    in the linked table that will be displayed in the view
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    $resource can also be a Resource class. In this case, if the
    <code>$titleField</code> property is specified, the field of the relation will be defined through it
</x-moonshine::alert>

<x-code language="php">
//...
class MoonShineUserResource extends Resource
{
public static string $model = MoonshineUser::class;

public static string $title = 'Administrators';

public string $titleField = 'name'; // [tl! focus]
//...
</x-code>

<x-sub-title id="hide-show">Displaying</x-sub-title>

<x-p>
    The fields are displayed at the page (the main page of the resource) and at the create/edit page.
    To exclude the field from the main page or the page with the form, you can use
    <code>hideOnIndex/hideOnForm/hideOnDetail</code> methods and <code>showOnIndex/showOnForm/showOnDetail</code> reverse methods.
    To exclude it from the edit or add page only -
    use <code>hideOnCreate/hideOnUpdate/showOnCreate/showOnUpdate</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            ID::make(),
            Text::make('Title', 'title')
            // [tl! focus:start]
                ->hideOnIndex()
                ->hideOnForm()
            // [tl! focus:end]
            ,
        ])
    ];
}

//...
</x-code>

<x-sub-title id="hide-show-conditions">Conditional display</x-sub-title>

<x-p>
    This method also accepts bool, or Closure
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            ID::make(),
            Text::make('Title', 'title')
            // [tl! focus:start]
                ->hideOnIndex(auth()->check())
            // [tl! focus:end]
            ,
        ])
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    As the form renders the html element, you can use basic html attributes as well.
    Such as <code>disabled</code>, <code>autocomplete</code>, <code>readonly</code>, <code>multiple</code> etc.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            Text::make('Title', 'title')
                ->disabled() // [tl! focus]
                ->hidden() // [tl! focus]
                ->readonly(), // [tl! focus]
            ];
        ])
    }

//...
</x-code>

<x-sub-title id="custom-attributes">Arbitrary attributes</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            Password::make('Password', 'password')
                ->customAttributes(['autocomplete' => 'off']) // [tl! focus]
        ])
    ];
}

//...
</x-code>

<x-sub-title id="required">Required field</x-sub-title>

<x-p>
    To make the field mandatory, you must use the <code>required</code> method
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            Text::make('Title', 'title')
                ->required() // [tl! focus]
        ])
    ];
}

//...
</x-code>

<x-sub-title id="dynamic">Dynamic value</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Block::make('Block title', [
            Text::make('Name', 'first_name', fn($item) => $item->first_name . ' ' . $item->last_name)

            // Example if you want to separate the logic for the main and for editing
            Text::make('Price', resource: function ($item) {
                if(request()->routeIs('*.index')) {
                    return $item->price;
                }

                return $item->exists ? $item->price->raw() : 0;
            }),
        ])
    ];
}

//...
</x-code>

<x-sub-title id="hint">Hint</x-sub-title>

<x-p>
    You can add a hint with a description to the field by calling the <code>hint</code>
</x-p>

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
    You can add a link to the field (e.g. with instructions)
    <code>addLink(string $name, string $link, bool $blank = false)</code>
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->addLink('YouTube', 'https://youtube.com') // [tl! focus]
            // or with the anonymous function
            ->addLink('Test', function() {
                if(!$this->getItem()) {
                    return route('admin.brands.index');
                }

                return route('admin.brands.edit', $this->getItem()->brand_id);
            }),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/link_dark.png') }}"></x-image>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    If you want to save NULL <code>nullable()</code> by default
</x-p>

<x-sub-title id="sortable">Sorting</x-sub-title>

<x-p>
    To be able to sort the field on the main page of the resource, you must add the <code>sortable</code> method
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->sortable() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="label">Hide label</x-sub-title>

<x-p>
    The <code>fieldContainer</code> method hides Label fields to save space,
    especially useful in conjunction with the <code>Flex</code> decoration
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->fieldContainer(false) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    Use the <code>default</code> method if you want to specify a default value for the field
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->default('-') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="show-when">Display condition</x-sub-title>

<x-p>
    There may be a need to display a field only if the value of
    another field in the form has a certain value (say, display the phone only if there is
    a check mark for it). Method <code>showWhen(string $field_name, string $item_value)</code>
</x-p>


<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->showWhen('has_phone', 1) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="can-save">Ability to save</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->canSave(false) // [tl! focus]
            // or
            ->canSave(fn() => false) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="events">Events</x-sub-title>

<x-p>
    When writing your own Fields, you may need to interact with events before and after saving.
    To do this, you have to implement the relevant methods in your custom field
</x-p>

<x-code language="php">
public function beforeSave(Model $item): void
{
    //
}

public function afterSave(Model $item): void
{
    //
}
</x-code>

<x-sub-title id="custom-view">Change view</x-sub-title>

<x-p>
    Sometimes it makes sense to change the view using a fluent interface
    (For example, if you use filters or fields outside of MoonShine)
</x-p>

<x-code language="php">
Text::make('Title')
    ->customView('fields.my-custom-input'),
</x-code>

<x-sub-title id="when-unless">Methods by condition</x-sub-title>

<x-p>
    The <code>when</code> method implements the <code>fluent interface</code>
    and will execute a callback when the first argument, passed to the method is true.
</x-p>

<x-code language="php">
Text::make('Slug')
    ->when(isset($this->getItem()->id), fn(Text $field) => $field->locked()),
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The field instance will be passed to the callback function.
</x-moonshine::alert>

<x-p>
    The second callback can be passed to the <code>when</code> method, it will be executed,
    when the first argument passed to the method has a false value.
</x-p>

<x-code language="php">
Text::make('Slug')
    ->when(
        isset($this->getItem()->id),
        fn(Text $field) => $field->locked(),
        fn(Text $field) => $field->hidden()
    ),
</x-code>

<x-p>
    The <code>unless</code> method is the reverse of the <code>when</code> method and will execute the first callback,
    when the first argument has a false value, otherwise the second callback will be executed if it was passed to the method.
</x-p>

<x-code language="php">
Text::make('Slug')
    ->unless(
        auth('moonshine')->user()->moonshine_user_role_id === 1,
        fn(Text $field) => $field->readonly()->hideOnCreate(),
        fn(Text $field) => $field->locked()
    ),
</x-code>

</x-page>
