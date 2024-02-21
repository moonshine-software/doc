<x-page title="Js events" :sectionMenu="[
    'Разделы' => [
        ['url' => '#blade-directives', 'label' => 'Blade directives'],
        ['url' => '#helper', 'label' => 'AlpineJs helper'],
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

</x-page>
