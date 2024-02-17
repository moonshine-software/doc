<x-page
    title="Компонент Modal"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#events', 'label' => 'События'],
            ['url' => '#open', 'label' => 'Состояние по умолчанию'],
            ['url' => '#close-outside', 'label' => 'Клик вне окна'],
            ['url' => '#autoclose', 'label' => 'Автозакрытие'],
            ['url' => '#wide', 'label' => 'Ширина окна'],
            ['url' => '#async', 'label' => 'Async'],
            ['url' => '#outer-attributes', 'label' => 'Атрибуты внешнего блока'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>Modal</em> позволяет создавать модальные окна.
</x-p>

<x-p>
    Создать <em>Modal</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(
    Closure|string $title,
    Closure|View|string $content,
    Closure|View|ActionButton|string $outer = '',
    Closure|string|null $asyncUrl = '',
    MoonShineRenderElements|null $components = null
)
</x-code>

<x-ul>
    <li><code>$title</code> - заголовок модального окна,</li>
    <li><code>$content</code> - контент модального окна,</li>
    <li><code>$outer</code> - внешний блок с обработчиком вызова окна,</li>
    <li><code>$asyncUrl</code> - url для асинхронного контента,</li>
    <li><code>$components</code> - компоненты для модального окна.</li>
</x-ul>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Modal; // [tl! focus]
use MoonShine\Fields\Password;
use MoonShine\Pages\PageComponents;

//...

public function components(): array
{
    return [
        Modal::make( // [tl! focus:start]
            title: 'Confirm',
            outer: ActionButton::make('Show modal', '#'),
            components: PageComponents::make([
                FormBuilder::make(route('password.confirm'))
                    ->async()
                    ->fields([
                        Password::make('Password')->eye(),
                    ])
                    ->submit('Confirm'),
            ])
        ) // [tl! focus:end]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make(
        'Confirm',
        static fn() => MoonShine\Components\FormBuilder::make(route('async'))
            ->async()
            ->fields([
                MoonShine\Fields\Password::make('Password')->eye(),
            ])
            ->submit('Confirm'),
        '<a class="btn" @click.prevent="toggleModal">Show modal</a>'
    )
!!}

<x-sub-title id="events">События</x-sub-title>

<x-p>
    Открыть или закрыть модальное окно не из компонента можно через <em>javascript</em> событиями.<br />
    Чтобы иметь доступ к событиям, необходимо задать уникальное имя модального окна, используя метод <code>name()</code>.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="вызов события через ActionButton" />

<x-p>
    Событие модального окна можно вызвать воспользовавшись компонентом <em>ActionButton</em>.
</x-p>
<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'),

        ActionButton::make(
            'Show modal',
            '#'
        )
            ->toggleModal('my-modal') // [tl! focus:-4]

        // or async
        ActionButton::make(
            'Show modal',
            '/endpoint'
        )
            ->async(events: ['modal-toggled-my-modal']) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-moonshine::divider label="вызов события нативными методами" />

<x-p>
    События можно вызвать воспользовавшись нативными методами <em>javascript</em>:
</x-p>

<x-code language="javascript">
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("modal-toggled-my-modal"))
})
</x-code>

<x-moonshine::divider label="вызов события методом Alpine.js" />

<x-p>
    Или воспользоваться магическим методом <code>$dispatch()</code> от <em>Alpine.js</em>:
</x-p>

<x-code language="javascript">
this.$dispatch('modal-toggled-my-modal')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Более подробную информацию можно получить из официальной документации Alpine.js в разделах
    <x-link link="https://alpinejs.dev/essentials/events" target="_blank">Events</x-link> и
    <x-link link="https://alpinejs.dev/magics/dispatch" target="_blank">$dispatch</x-link>.
</x-moonshine::alert>

<x-sub-title id="open">Состояние по умолчанию</x-sub-title>

<x-p>
    Метод <code>open()</code> позволяет раскрыть модальное окно при загрузке страницы.
</x-p>

<x-code language="php">
open(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', view('path'))
            ->open(), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию при загрузке страницы модальное окно будет закрытым.
</x-moonshine::alert>

<x-sub-title id="close-outside">Клик вне окна</x-sub-title>

<x-p>
    По умолчанию модальное окно закрывается при клике вне области окна.<br />
    Метод <code>closeOutside()</code> позволяет переопределить такое поведение.
</x-p>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->closeOutside(false), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn" @click.prevent="toggleModal">Show modal</a>')->closeOutside(false)
!!}

<x-sub-title id="autoclose">Автозакрытие</x-sub-title>

<x-p>
    По умолчанию модальные окна после успешного запроса закрываются,
    метод <code>autoClose()</code> позволяет контролировать это поведение.
</x-p>

<x-code language="php">
autoClose(Closure|bool|null $autoClose = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Demo modal',
            static fn() => FormBuilder::make(route('alert.post'))
                ->fields([
                    Text::make('Text'),
                ])
                ->submit('Send', ['class' => 'btn-primary'])
                ->async(),
        )
            ->name('demo-modal')
            ->autoClose(false), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make(
        'Confirm',
        static fn() => MoonShine\Components\FormBuilder::make(route('async'))
            ->async()
            ->fields([
                MoonShine\Fields\Password::make('Password')->eye(),
            ])
            ->submit('Confirm'),
        '<a class="btn" @click.prevent="toggleModal">Show modal</a>'
    )->autoClose(false);
!!}

<x-sub-title id="wide">Ширина окна</x-sub-title>

<x-moonshine::divider label="wide" />

<x-p>
    Метод <code>wide()</code> компонента <em>Modal</em> устанавливает максимальную ширину модального окна.
</x-p>

<x-code language="php">
wide(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->wide(), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn" @click.prevent="toggleModal">Show modal</a>')->wide()
!!}

<x-moonshine::divider label="auto" />

<x-p>
    Метод <code>auto()</code> компонента <em>Modal</em> устанавливает ширину модального окна по контенту.
</x-p>

<x-code language="php">
auto(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->auto(), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn" @click.prevent="toggleModal">Show modal</a>')->auto()
!!}

<x-sub-title id="async">Async</x-sub-title>

<x-code>
Modal::make('Title', '', ActionButton::make('Show modal', '#'), asyncUrl: '/endpoint'), // [tl! focus]
</x-code>

{!! MoonShine\Components\Modal::make('Title', '', '<a class="btn" @click.prevent="toggleModal">Show modal</a>', asyncUrl: to_page('action_button', fragment: 'doc-content')) !!}

<br />

<x-moonshine::alert>
    Запрос будет отправлен единоразово, но если вам необходимо при каждом открытии отправлять запрос,
    то воспользуйтесь атрибутом <code>data-always-load</code>
</x-moonshine::alert>

<x-code>
    Modal::make(...)
        ->customAttributes(['data-always-load' => true]), // [tl! focus]
</x-code>

<x-sub-title id="outer-attributes">Атрибуты внешнего блока</x-sub-title>

<x-p>
    Метод <code>outerAttributes()</code> позволяет установить дополнительные атрибуты для внешнего блока <code>$outer</code>.
</x-p>

<x-code language="php">
outerAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->outerAttributes([
                'class' => 'mt-2'
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
