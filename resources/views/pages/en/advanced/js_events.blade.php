<x-page title="Js events" :sectionMenu="[
    'Разделы' => [
        ['url' => '#blade-directives', 'label' => 'Blade directives'],
        ['url' => '#helper', 'label' => 'AlpineJs helper'],
        ['url' => '#default-events', 'label' => 'Default events'],
        ['url' => '#response-events', 'label' => 'Calling events via Response'],
    ]
]">

<x-sub-title id="blade-directives">Blade directives</x-sub-title>

<x-p>
    <em>Blade directives</em> are used to quickly declare events for components.
</x-p>

<x-moonshine::divider label="@defineEvent" />

<x-code language="php">
@@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$event</code> - event</li>
    <li><code>$name</code> - component name</li>
    <li><code>$call</code> - callback function.</li>
</x-ul>

<x-code language="php">
<div x-data="myComponent"
    // @table-updated-index.window="asyncRequest"
    @@defineEvent('table-updated', 'index', 'asyncRequest')
>
</div>
</x-code>

<x-moonshine::divider label="@defineEventWhen" />

<x-code language="php">
@@defineEventWhen(mixed $condition, string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$condition</code> - condition for the event</li>
    <li><code>$event</code> - event</li>
    <li><code>$name</code> - component name</li>
    <li><code>$call</code> - callback function.</li>
</x-ul>

<x-code language="php">
<div x-data="myComponent"
    // @table-updated-index.window="asyncRequest"
    @@defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
>
</div>
</x-code>

<x-sub-title id="helper">AlpineJs helper</x-sub-title>

<x-p>
    <em>AlpineJs</em> helper class for generating events.
</x-p>

<x-moonshine::divider label="AlpineJs::event()" />

<x-code language="php">
AlpineJs::event(string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$event</code> - event</li>
    <li><code>$name</code> - component name</li>
    <li><code>$call</code> - callback function.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\FormBuilder;
use MoonShine\Enums\JsEvent;
use MoonShine\Support\AlpineJs;

FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form')
    ->async(asyncEvents: [AlpineJs::event(JsEvent::TABLE_UPDATED, 'index', 'asyncRequest')]) // [tl! focus]
</x-code>

<x-moonshine::divider label="AlpineJs::eventBlade()" />

<x-code language="php">
AlpineJs::eventBlade(string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$event</code> - event</li>
    <li><code>$name</code> - component name</li>
    <li><code>$call</code> - callback function.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\FormBuilder;
use MoonShine\Enums\JsEvent;
use MoonShine\Support\AlpineJs;

FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form')
    ->customAttributes([
        // @form-reset-main-form.window="formReset"
        AlpineJs::eventBlade(JsEvent::FORM_RESET, 'main-form') => 'formReset',  // [tl! focus]
    ]);
</x-code>

<x-sub-title id="default-events">Default events</x-sub-title>

<x-p>
    There are several default events defined in the <strong>MoonShine</strong> admin panel,
    the names of which can be conveniently obtained via enum <em>JsEvent</em>.
</x-p>

<x-ul>
    <li><code>JsEvent::FRAGMENT_UPDATED</code> - fragment update,</li>
    <li><code>JsEvent::TABLE_UPDATED</code> - table update,</li>
    <li><code>JsEvent::TABLE_REINDEX</code> - updating table indexes when sorting,</li>
    <li><code>JsEvent::TABLE_ROW_UPDATED</code> - updating a row in the table,</li>
    <li><code>JsEvent::CARDS_UPDATED</code> - updating the Cards list,</li>
    <li><code>JsEvent::FORM_RESET</code> - form reset,</li>
    <li><code>JsEvent::FORM_SUBMIT</code> - submitting the form,</li>
    <li><code>JsEvent::MODAL_TOGGLED</code> - opening / closing a modal window,</li>
    <li><code>JsEvent::OFF_CANVAS_TOGGLED</code> - opening / closing Offcanvas,</li>
    <li><code>JsEvent::TOAST</code> - call Toast.</li>
</x-ul>

<x-sub-title id="response-events">Calling events via Response</x-sub-title>

<x-p>
    In <strong>MoonShine</strong> you can return events to <em>MoonShineJsonResponse</em>, which will then be called.<br />
    To do this, you need to use the <code>events()</code> method.
</x-p>

<x-code language="php">
events(array $events)
</x-code>

<x-ul>
    <li><code>$events</code> - array of events to be called.</li>
</x-ul>

<x-code language="php">
use MoonShine\Enums\JsEvent;
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\Support\AlpineJs;

//...

return MoonShineJsonResponse::make()
    ->events([
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index'),
    ]); // [tl! focus:-2]
</x-code>

</x-page>
