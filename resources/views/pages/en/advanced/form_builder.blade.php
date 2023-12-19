@php use MoonShine\Fields\Text; @endphp
<x-page
    title="FormBuilder"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#methods', 'label' => 'Methods'],
            ['url' => '#async', 'label' => 'Asynchronous mode'],
            ['url' => '#apply', 'label' => 'Apply'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Fields and decorations in MoonShine are used inside forms, which are handled by FormBuilder.
    Thanks to FormBuilder, fields are displayed and filled with data.
    You can also use FormBuilder on your own pages or even outside of MoonShine.
</x-p>

<x-code language="php">
make(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
</x-code>

<x-ul>
    <li><code>action</code> - handler</li>
    <li><code>method</code> - request type,</li>
    <li><code>fields</code> - fields and decorations.</li>
    <li><code>values </code> - field values.</li>
</x-ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
</x-code>

<x-p>
    Same thing through methods:
</x-p>

<x-code language="php">
FormBuilder::make()
    ->action('/crud/update')
    ->method('PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
</x-code>

<x-p>
    Helper is also available:
</x-p>

<x-code language="php">
@{!! form(request()->url(), 'GET')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
!!}
</x-code>

{!!
    form(request()->url(), 'GET')
        ->fields([
            Text::make('Text')
        ])
        ->fill(['text' => 'Value'])
!!}


<x-sub-title id="methods">Methods</x-sub-title>

<x-moonshine::divider label="fields" />

<x-p>
    The <code>fields</code> method for declaring form fields and decorations:
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
</x-code>

<x-moonshine::divider label="fill" />

<x-p>
    <code>fill</code> method for filling fields with values:
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value'])
</x-code>

<x-moonshine::divider label="cast" />

<x-p>
    The <code>cast</code> method for casting form values to a specific type.
    Since by default fields work with primitive types:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(['text' => 'value'], ModelCast::make(User::class))
</x-code>

<x-code language="php">
    use MoonShine\TypeCasts\ModelCast;

    FormBuilder::make('/crud/update', 'PUT')
    ->fields([
    Heading::make('Title'),
    Text::make('Text'),
    ])
    ->fillCast(User::query()->first(), ModelCast::make(User::class))
</x-code>

<x-p>
    In this example, we cast the data to the <code>User</code> model format using <code>ModelCast</code>.
</x-p>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Read more about TypeCasts in the section of the same name
    </x-moonshine::alert>
</x-p>

<x-moonshine::divider label="buttons" />

<x-p>
    Form buttons can be modified and added.
</x-p>

<x-p>
    To customize the "submit" button, use the <code>submit</code> method
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Click me', attributes: ['class' => 'btn-primary'])
</x-code>

<x-p>
    To add new buttons based on <code>ActionButton</code>, use the <code>buttons</code> method
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Delete', route('name.delete'))
    ])
</x-code>

<x-moonshine::divider label="Attributes" />

<x-p>
    You can set any html attributes for the form using the <code>customAttributes</code> method.
</x-p>

<x-code>
FormBuilder::make()->customAttributes(['class' => 'custom-form']),
</x-code>

<x-sub-title id="async">Asynchronous mode</x-sub-title>

<x-p>
    If you need to submit the form asynchronously, use the <code>async</code> method.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->async()
</x-code>

<x-p>
    After a successful request, you can raise events by adding the <code>asyncEvents</code> parameter.
</x-p>

<x-code language="php">
    FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.information-circle">
    MoonShine already has a set of ready-made events
</x-moonshine::alert>

<x-ul>
    <li><code>table-updated-{name}</code> - Updating an asynchronous table by its name</li>
    <li><code>form-reset-{name}</code> - Reset form values by its name</li>
    <li><code>fragment-updated-{name}</code> - Updates a blade fragment by its name</li>
</x-ul>

<x-p>
    If you need to perform precognition validation first, you need the <code>precognitive</code> method.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive()
</x-code>

@include('pages.en.recipes.form-with-events')

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    The <code>apply()</code> method in <em>FormBuilder</em> iterates through all form fields and calls their apply methods.
</x-p>

<x-code language="php">
apply(
    Closure $apply,
    ?Closure $default = null,
    ?Closure $before = null,
    ?Closure $after = null,
    bool $throw = false,
)
</x-code>

<x-ul>
    <li><code>$apply</code> - callback function;</li>
    <li><code>$default</code> - apply for the default field;</li>
    <li><code>$before</code> - callback function before apply;</li>
    <li><code>$after</code> - callback function after apply;</li>
    <li><code>$throw</code> - throw exceptions.</li>
</x-ul>

<x-moonshine::divider label="Examples" />

<x-p>
    It is necessary to save the data of all <em>FormBuilder</em> fields in the controller:
</x-p>

<x-code language="php">
$form->apply(fn(Model $item) => $item->save());
</x-code>

<x-p>
    A more complex option, indicating events before and after saving:
</x-p>

<x-code language="php">
$form->apply(
    static fn(Model $item) => $item->save(),
    before: function (Model $item) {
        if (! $item->exists) {
            $item = $this->beforeCreating($item);
        }

        if ($item->exists) {
            $item = $this->beforeUpdating($item);
        }

        return $item;
    },
    after: function (Model $item) {
        $wasRecentlyCreated = $item->wasRecentlyCreated;

        $item->save();

        if ($wasRecentlyCreated) {
            $item = $this->afterCreated($item);
        }

        if (! $wasRecentlyCreated) {
            $item = $this->afterUpdated($item);
        }

        return $item;
    },
    throw: true
);
</x-code>

</x-page>
