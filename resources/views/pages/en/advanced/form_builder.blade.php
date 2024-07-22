@php use MoonShine\Fields\Text; @endphp
<x-page
    title="FormBuilder"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#fields', 'label' => 'Fields'],
            ['url' => '#fill', 'label' => 'Fill fields'],
            ['url' => '#cast', 'label' => 'Casting'],
            ['url' => '#fillCast', 'label' => 'FillCast'],
            ['url' => '#buttons', 'label' => 'Buttons'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#name', 'label' => 'Form name'],
            ['url' => '#async', 'label' => 'Asynchronous mode'],
            ['url' => '#precognitive', 'label' => 'Precognitive'],
            ['url' => '#apply', 'label' => 'Apply'],
            ['url' => '#method', 'label' => 'Calling methods'],
            ['url' => '#event', 'label' => 'Dispatch events'],
            ['url' => '#submit', 'label' => 'Submit event'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Fields and decorations in <em>FormBuilder</em>  are used inside forms, which are handled by FormBuilder.<br />
    Thanks to <em>FormBuilder</em> , fields are displayed and filled with data.<br />
    You can also use <em>FormBuilder</em>  on your own pages or even outside of <strong>MoonShine</strong>.
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
    <li><code>values</code> - field values.</li>
</x-ul>

<x-code language="php">
FormBuilder::make(
    action:'/crud/update',
    method: 'PUT',
    fields: [
        Text::make('Text')
    ],
    values: ['text' => 'Value']
)
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

<x-sub-title id="fields">Fields</x-sub-title>

<x-p>
    The <code>fields()</code> method for declaring form fields and decorations:
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ]) // [tl! focus:-3]
</x-code>

<x-sub-title id="fill">Fill fields</x-sub-title>

<x-p>
    <code>fill()</code> method for filling fields with values:
</x-p>

<x-code language="php">
fill(mixed $values = [])
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value']) // [tl! focus]
</x-code>

<x-sub-title id="cast">Casting</x-sub-title>

<x-p>
    The <code>cast()</code> method for casting form values to a specific type.
    Since by default fields work with primitive types:
</x-p>

<x-code language="php">
cast(MoonShineDataCast $cast)
</x-code>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->cast(ModelCast::make(User::class)) // [tl! focus]
</x-code>

<x-p>
    In this example, we cast the data to the <code>User</code> model format using <code>ModelCast</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('advanced-type_casts') }}">TypeCasts</x-link>
</x-moonshine::alert>

<x-sub-title id="fillCast">FillCast</x-sub-title>

<x-p>
    The <code>fillCast()</code> method allows you to cast data to a specific type and immediately fill it with values:
</x-p>

<x-code language="php">
fillCast(mixed $values, MoonShineDataCast $cast)
</x-code>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    ) // [tl! focus:-3]
</x-code>

<x-p>or</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        User::query()->first(),
        ModelCast::make(User::class)
    ) // [tl! focus:-3]
</x-code>

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    Form buttons can be modified and added.
</x-p>

<x-p>
    To customize the "submit" button, use the <code>submit()</code> method.
</x-p>

<x-code language="php">
submit(string $label, array $attributes = [])
</x-code>

<x-ul>
    <li><code>label</code> - button name,</li>
    <li><code>attributes</code> - additional attributes.</li>
</x-ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Click me', attributes: ['class' => 'btn-primary']) // [tl! focus]
</x-code>

<x-p>
    The <code>hideSubmit()</code> method allows you to hide the <strong>"submit"</strong> button.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->hideSubmit() // [tl! focus]
</x-code>

<x-p>
    To add new buttons based on <code>ActionButton</code>, use the <code>buttons()</code> method
</x-p>

<x-code language="php">
buttons(array $buttons = [])
</x-code>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Delete', route('name.delete'))
    ]) // [tl! focus:-2]
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    You can set any html attributes for the form using the <code>customAttributes()</code> method.
</x-p>

<x-code>
FormBuilder::make()
    ->customAttributes(['class' => 'custom-form']) // [tl! focus]
</x-code>

<x-sub-title id="name">Form name</x-sub-title>

<x-p>
    The <code>name()</code> method allows you to set a unique name for the form through which events can be raised.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form') // [tl! focus]
</x-code>

<x-sub-title id="async">Asynchronous mode</x-sub-title>

<x-p>
    If you need to submit the form asynchronously, use the <code>async()</code> method.
</x-p>

<x-code language="php">
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
</x-code>

<x-ul>
    <li><code>asyncUrl</code> - request url (by default the request is sent via action url),</li>
    <li><code>asyncEvents</code> - events raised after a successful request,</li>
    <li><code>asyncCallback</code> - js callback function after receiving a response.</li>
</x-ul>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->async() // [tl! focus]
</x-code>

<x-p>
    After a successful request, you can raise events by adding the <code>asyncEvents</code> parameter.
</x-p>

<x-code language="php">
    FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form']) // [tl! focus]
</x-code>

<x-p>
    <strong>MoonShine</strong> already has a set of ready-made events:
</x-p>

<x-ul>
    <li><code>table-updated-{name}</code> - updating an asynchronous table by its name,</li>
    <li><code>form-reset-{name}</code> - reset form values by its name,</li>
    <li><code>fragment-updated-{name}</code> - updates a blade fragment by its name.</li>
</x-ul>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Recipe:
    <x-link link="{{ to_page('recipes') }}#form-with-events">
        Upon a successful request, the form updates the table and resets the values
    </x-link>.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The <code>async()</code> method must come after the <code>name()</code> method!
</x-moonshine::alert>

<x-sub-title id="precognitive">Precognitive</x-sub-title>

<x-p>
    If you need to perform precognition validation first, you need the <code>precognitive()</code> method.
</x-p>

<x-code language="php">
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive() // [tl! focus]
</x-code>

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

<x-sub-title id="method">Calling methods</x-sub-title>

<x-p>
    <code>asyncMethod()</code> allow you to specify the name of the method in the resource and call it asynchronously when sending
    <em>FormBuilder</em> without the need to create additional controllers.
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        FormBuilder::make()
            ->asyncMethod('updateSomething'), // [tl! focus]
    ];
}
</x-code>

<x-code language="php">
// With toast
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('MyMessage', 'success');

    return back();
}

// Exception
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('My message');
}

// Custom json response
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('MyMessage', ToastType::SUCCESS);
}
</x-code>

<x-sub-title id="event">Dispatch events</x-sub-title>

<x-p>
    To dispatch javascript events, you can use the <code>dispatchEvent()</code> method.
</x-p>

<x-code language="php">
dispatchEvent(array|string $events)
</x-code>

<x-code language="php">
FormBuilder::make()
    ->dispatchEvent(JsEvent::OFF_CANVAS_TOGGLED, 'default'), // [tl! focus]
</x-code>

<x-sub-title id="submit">&quot;Submit&quot; event</x-sub-title>

<x-p>
    To submit a form, you can call the <em>Submit</em> event.
</x-p>

<x-code language="php">
AlpineJs::event(JsEvent::FORM_SUBMIT, 'componentName')
</x-code>

<x-moonshine::divider label="Example of calling an event on a form page" />

<x-code language="php">
public function formButtons(): array
{
    return [
       ActionButton::make('Save')->dispatchEvent(AlpineJs::event(JsEvent::FORM_SUBMIT, $this->uriKey()))
    ];
}
</x-code>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    For more information about AlpineJs helpers, please refer to
    <x-link link="{{ to_page('advanced-js_events') }}#helper">Js events</x-link>.
</x-moonshine::alert>

</x-page>
