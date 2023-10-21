<x-page title="ActionButton"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#methods', 'label' => 'Методы'],
            ['url' => '#modal', 'label' => 'Modal'],
            ['url' => '#offcanvas', 'label' => 'Offcanvas'],
            ['url' => '#group', 'label' => 'Методы группы'],
        ]
    ]"
>
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Когда Вам необходимо добавить кнопку с определенным действием, на помощь приходят ActionButton.
    В MoonShine они уже используются - в формах, таблицах, на страницах
</x-p>

<x-code language="php">
make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<ul>
    <li><code>label</code> - Текст кнопки,</li>
    <li><code>url</code> - Url,</li>
    <li><code>item</code> - Опциональные данные кнопки, доступные в замыканиях.</li>
</ul>

<x-code>
public function components(): array
    return [
        ActionButton::make(
            label: 'Button title',
            url: 'https://moonshine-laravel.com',
        ),
    ];
}
</x-code>

<x-p>
    Также доступен helper, который можно применить в blade
</x-p>

<x-code>
<div>
    @{!! actionBtn('Click me', 'https://moonshine-laravel.com') !!}
</div>
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com') !!}

<x-sub-title id="methods">Методы</x-sub-title>

<x-moonshine::divider label="blank" />

<x-p>
    Открыть в новом окне
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->blank(),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->blank() !!}

<x-moonshine::divider label="icon" />

<x-p>
    Иконка
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->icon('heroicons.outline.pencil'),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->icon('heroicons.outline.pencil') !!}

<x-moonshine::divider label="Attributes" />

<x-p>
    Вы можете задать любые html атрибуты для кнопки через метод customAttributes
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->customAttributes(['class' => 'btn-primary']),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->customAttributes(['class' => 'btn-primary']) !!}

<x-moonshine::divider label="Цвета" />

<x-p>
    Чтобы не держать в голове классы для изменения цвета кнопки, мы подготовили для вас готовые класы
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->primary(), //secondary, warning, success, error
</x-code>

{!! actionBtn('Primary', 'https://moonshine-laravel.com')->primary() !!}
{!! actionBtn('Secondary', 'https://moonshine-laravel.com')->secondary() !!}
{!! actionBtn('Warning', 'https://moonshine-laravel.com')->warning() !!}
{!! actionBtn('Success', 'https://moonshine-laravel.com')->success() !!}
{!! actionBtn('Error', 'https://moonshine-laravel.com')->error() !!}

<x-moonshine::divider label="onClick" />

<x-p>
    Возможность выполнить js по клику
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->onClick(fn() => 'alert("Example")', 'prevent'),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->onClick(fn() => 'alert("Example")', 'prevent') !!}

<x-sub-title id="modal">Modal</x-sub-title>
<x-moonshine::divider label="Basics" />

<x-p>
    Для того, чтобы по клику на кнопку произошел вызов модального окна, воспользуйтесь методом <code>inModal</code>
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->inModal(
    title: fn() => 'Modal title',
    content: fn() => 'Modal content',
    buttons: [
        ActionButton::make('Click me in modal', 'https://moonshine-laravel.com')
    ],
    async: false
),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inModal(fn() => 'Modal title', fn() => 'Modal content', [
        actionBtn('Click me in modal', 'https://moonshine-laravel.com')
]) !!}

<x-moonshine::divider label="withConfirm" />

<x-p>
    Быстрый способ создать кнопка с подтверждением действия <code>withConfirm</code>
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->withConfirm(
    'Confirm modal title',
    'Confirm modal content',
    'Confirm modal button',
),
</x-code>

<x-moonshine::divider label="Async" />

<x-p>
    Если требуется подгрузить контент в модальное окно асинхронно, то переключите параметр async в true
</x-p>

@fragment('action-btn-fragment')
<x-code>
ActionButton::make(
    label: 'Click me',
    url: route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']),
)->inModal(
    title: fn() => 'Modal title',
    async: true
),
</x-code>
@endfragment

{!! actionBtn('Example', route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']))->inModal(
    title: fn() => 'Modal title',
    async: true
) !!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        О Fragment можно узнать в разделе "Декорации"
    </x-moonshine::alert>
</x-p>

<x-sub-title id="offcanvas">Offcanvas</x-sub-title>

<x-p>
    Для того, чтобы по клику на кнопку произошел вызов offcanvas, воспользуйтесь методом <code>inOffCanvas</code>
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->inOffCanvas(fn() => 'OffCanvas title', fn() => form()->fields([Text::make('Text')]), isLeft: false) ,
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inOffCanvas(fn() => 'OffCanvas title', fn() => form()->fields([MoonShine\Fields\Text::make('Text')])) !!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        О FormBuilder можно узнать в разделе "Advanced"
    </x-moonshine::alert>
</x-p>

<x-sub-title id="group">Методы группы</x-sub-title>

<x-p>
    Если Вам необходимо выстроить логику с несколькими <code>ActionButton</code>, при этом некоторые должны быть скрыты или отображаться в выпадающем меню,
    в таком случае воспользуйтесь компонентом <code>ActionGroup</code>
</x-p>

<x-moonshine::divider label="canSee" />

<x-p>
    Условие отображения
</x-p>

<x-code>
public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->canSee(fn() => false),
            ActionButton::make('Button 2', '/', $model)->canSee(fn($model) => $model->active)
        ])
    ];
}
</x-code>

<x-moonshine::divider label="Отображение" />

<x-p>
    Вы также благодаря ActionGroup можете изменить отображение кнопок, отображать их в линию или же в выпадающем меню для экономии места
</x-p>

<x-code>
public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->showInLine(),
            ActionButton::make('Button 2', '/')->showInDropdown()
        ])
    ];
}
</x-code>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Метод <code>bulk()</code>, используется только внутри ModelResource
    </x-moonshine::alert>
</x-p>
</x-page>