<x-page title="Js события" :sectionMenu="[
    'Разделы' => [
        ['url' => '#blade-directives', 'label' => 'Blade-директивы'],
        ['url' => '#helper', 'label' => 'Помощник AlpineJs'],
    ]
]">

<x-sub-title id="blade-directives">Blade-директивы</x-sub-title>

<x-p>
    <em>Blade-директивы</em> используются для быстрого объявления событий у компонентов.
</x-p>

<x-moonshine::divider label="@defineEvent" />

<x-code language="php">
@@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$event</code> - событие,</li>
    <li><code>$name</code> - название компонента,</li>
    <li><code>$call</code> - callback функция.</li>
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
    <li><code>$condition</code> - условие для события,</li>
    <li><code>$event</code> - событие,</li>
    <li><code>$name</code> - название компонента,</li>
    <li><code>$call</code> - callback функция.</li>
</x-ul>

<x-code language="php">
<div x-data="myComponent"
    // @table-updated-index.window="asyncRequest"
    @@defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
>
</div>
</x-code>

<x-sub-title id="helper">Помощник AlpineJs</x-sub-title>

<x-p>
    <em>AlpineJs</em> класс-помощник, для формирования событий.
</x-p>

<x-moonshine::divider label="AlpineJs::event()" />

<x-code language="php">
AlpineJs::event(string|JsEvent $event, ?string $name = null, ?string $call = null)
</x-code>

<x-ul>
    <li><code>$event</code> - событие,</li>
    <li><code>$name</code> - название компонента,</li>
    <li><code>$call</code> - callback функция.</li>
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
    <li><code>$event</code> - событие,</li>
    <li><code>$name</code> - название компонента,</li>
    <li><code>$call</code> - callback функция.</li>
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
