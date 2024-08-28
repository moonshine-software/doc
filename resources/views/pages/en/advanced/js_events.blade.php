<x-page title="Js события" :sectionMenu="[
    'Разделы' => [
        ['url' => '#blade-directives', 'label' => 'Blade-директивы'],
        ['url' => '#helper', 'label' => 'Помощник AlpineJs'],
        ['url' => '#default-events', 'label' => 'События по умолчанию'],
        ['url' => '#response-events', 'label' => 'Вызов событий через Response'],
    ]
]">

    <x-sub-title id="blade-directives">Blade-директивы</x-sub-title>

    <x-p>
        <em>Blade-директивы</em> используются для быстрого объявления событий у компонентов.
    </x-p>

    <x-moonshine::divider label="@defineEvent" />

    <x-code language="php">
        @@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
    </x-code>

    <x-ul>
        <li><code>$event</code> - событие,</li>
        <li><code>$name</code> - название компонента,</li>
        <li><code>$call</code> - callback функция.</li>
        <li><code>$params</code> - параметры события.</li>
    </x-ul>

    <x-code language="php">
        <div x-data="myComponent">
            // @table-updated-index.window="asyncRequest"
            @@defineEvent('table-updated', 'index', 'asyncRequest')
            >
        </div>
    </x-code>

    <x-moonshine::divider label="@defineEventWhen" />

    <x-code language="php">
        @@defineEventWhen(mixed $condition, string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
    </x-code>

    <x-ul>
        <li><code>$condition</code> - условие для события,</li>
        <li><code>$event</code> - событие,</li>
        <li><code>$name</code> - название компонента,</li>
        <li><code>$call</code> - callback функция.</li>
        <li><code>$params</code> - параметры события.</li>
    </x-ul>

    <x-code language="php">
        <div x-data="myComponent">
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
        AlpineJs::event(string|JsEvent $event, ?string $name = null, array $params = [])
    </x-code>

    <x-ul>
        <li><code>$event</code> - событие,</li>
        <li><code>$name</code> - название компонента,</li>
        <li><code>$params</code> - параметры события</li>
    </x-ul>

    <x-code language="php">
        use MoonShine\Components\FormBuilder;
        use MoonShine\Enums\JsEvent;
        use MoonShine\Support\AlpineJs;

        FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: [AlpineJs::event(JsEvent::TABLE_UPDATED, 'index', ['var' => 'foo])]) // [tl! focus]
    </x-code>

    <x-moonshine::divider label="AlpineJs::eventBlade()" />

    <x-code language="php">
        AlpineJs::eventBlade(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
    </x-code>

    <x-ul>
        <li><code>$event</code> - событие,</li>
        <li><code>$name</code> - название компонента,</li>
        <li><code>$call</code> - callback функция.</li>
        <li><code>$params</code> - параметры события</li>
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

    <x-sub-title id="default-events">События по умолчанию</x-sub-title>

    <x-p>
        В админ-панели <strong>MoonShine</strong> определены несколько событий по умолчанию,
        названия которых можно удобно получить через enum <em>JsEvent</em>.
    </x-p>

    <x-ul>
        <li><code>JsEvent::FRAGMENT_UPDATED</code> - обновление фрагмента,</li>
        <li><code>JsEvent::TABLE_UPDATED</code> - обновление таблицы,</li>
        <li><code>JsEvent::TABLE_REINDEX</code> - обновление индексов таблицы при сортировке,</li>
        <li><code>JsEvent::TABLE_ROW_UPDATED</code> - обновление строки в таблице,</li>
        <li><code>JsEvent::CARDS_UPDATED</code> - обновление списка Сards,</li>
        <li><code>JsEvent::FORM_RESET</code> - сброс формы,</li>
        <li><code>JsEvent::FORM_SUBMIT</code> - отправка формы,</li>
        <li><code>JsEvent::MODAL_TOGGLED</code> - открытие / закрытие модального окна,</li>
        <li><code>JsEvent::OFF_CANVAS_TOGGLED</code> - открытие / закрытие Offcanvas,</li>
        <li><code>JsEvent::TOAST</code> - вызов Toast.</li>
    </x-ul>

    <x-sub-title id="response-events">Вызов событий через Response</x-sub-title>

    <x-p>
        В <strong>MoonShine</strong> можно вернуть события в <em>MoonShineJsonResponse</em>, которые потом будут вызваны.<br />
        Для этого необходимо воспользоваться методом <code>events()</code>.
    </x-p>

    <x-code language="php">
        events(array $events)
    </x-code>

    <x-ul>
        <li><code>$events</code> - массив вызываемых событий.</li>
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
