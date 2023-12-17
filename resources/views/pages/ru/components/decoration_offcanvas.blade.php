<x-page
    title="Компонент Offcanvas"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#events', 'label' => 'События'],
            ['url' => '#open', 'label' => 'Состояние по умолчанию'],
            ['url' => '#position', 'label' => 'Расположение'],
            ['url' => '#toggler-attributes', 'label' => 'Аттрибуты переключателя'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>Offcanvas</em> позволяет создавать боковые панели.
</x-p>

<x-p>
    Создать <em>Offcanvas</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string $title, Closure|View|string $content, Closure|string $toggler = '', Closure|string|null $asyncUrl = '')
</x-code>

<x-p>
    <ul>
        <li><code>$title</code> - заголовок боковой панели,</li>
        <li><code>$content</code> - контент боковой панели,</li>
        <li><code>$toggler</code> - заголовок для переключателя,</li>
        <li><code>$asyncUrl</code> - url для асинхронного контента.</li>
    </ul>
</x-p>

<x-code language="php">
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Offcanvas; // [tl! focus]
use MoonShine\Fields\Password;

//...

public function components(): array
{
    return [
        Offcanvas::make( // [tl! focus:start]
            'Confirm',
            static fn() => FormBuilder::make(route('password.confirm'))
                ->async()
                ->fields([
                    Password::make('Password')->eye(),
                ])
                ->submit('Confirm'),
            'Show canvas'
        ) // [tl! focus:end]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Offcanvas::make(
        'Confirm',
        static fn() => MoonShine\Components\FormBuilder::make(route('async'))
            ->async()
            ->fields([
                MoonShine\Fields\Password::make('Password')->eye(),
            ])
            ->submit('Confirm'),
        'Show canvas'
    )
!!}

<x-sub-title id="events">События</x-sub-title>

<x-p>
    Показать или скрыть боковую панель не из компонента можно через <em>javascript</em> событиями.<br />
    Чтобы иметь доступ к событиям, необходимо задать уникальное имя боковой панели, используя метод <code>name()</code>.
</x-p>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...'
        )
            ->name('my-canvas') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="вызов события через ActionButton" />

<x-p>
    Событие боковой панели можно вызвать, воспользовавшись компонентом <em>ActionButton</em>.
</x-p>
<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...',
        )
            ->name('my-canvas'),

        ActionButton::make(
            'Show canvas',
            '/endpoint'
        )
            ->async(events: ['offcanvas-toggled-my-canvas']) // [tl! focus:-4]
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
    this.dispatchEvent(new Event("offcanvas-toggled-my-canvas"))
})
</x-code>

<x-moonshine::divider label="вызов события методом Alpine.js" />

<x-p>
    Или воспользоваться магическим методом <code>$dispatch()</code> от <em>Alpine.js</em>:
</x-p>

<x-code language="javascript">
this.$dispatch('offcanvas-toggled-my-canvas')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Более подробную информацию можно получить из официальной документации Alpine.js в разделах
    <x-link link="https://alpinejs.dev/essentials/events" target="_blank">Events</x-link> и
    <x-link link="https://alpinejs.dev/magics/dispatch" target="_blank">$dispatch</x-link>.
</x-moonshine::alert>

<x-sub-title id="open">Состояние по умолчанию</x-sub-title>

<x-p>
    Метод <code>open()</code> позволяет показать боковую панель при загрузке страницы.
</x-p>

<x-code language="php">
open(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->open() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию при загрузке страницы боковая панель будет скрыта.
</x-moonshine::alert>

<x-sub-title id="position">Расположение</x-sub-title>

<x-p>
    По умолчанию боковая панель располагается с правой стороны экрана,
    метод <code>left()</code> позволяет расположить панель с левой стороны.
</x-p>

<x-code language="php">
left(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->left() // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Offcanvas::make('Title', 'Content...', 'Show canvas')
        ->left()
!!}

<x-sub-title id="toggler-attributes">Аттрибуты переключателя</x-sub-title>

<x-p>
    Метод <code>togglerAttributes()</code> позволяет установить дополнительные аттрибуты для переключателя <code>$toggler</code>.
</x-p>

<x-code language="php">
togglerAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->togglerAttributes([
                'class' => 'mt-2'
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
