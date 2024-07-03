<x-page
    title="Компонент Dropdown"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#toggler', 'label' => 'Переключатель'],
            ['url' => '#items', 'label' => 'Элементы'],
            ['url' => '#searchable', 'label' => 'Поиск по элементам'],
            ['url' => '#content', 'label' => 'Контент'],
            ['url' => '#placement', 'label' => 'Расположение'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Dropdown</em> позволяет создавать выпадающие блоки.
</x-p>

<x-p>
    Создать <em>Dropdown</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Dropdown</code>.
</x-p>

<x-code language="php">
make(
    ?string $title = null,
    Closure|string $toggler = '',
    Closure|View|string $content = '',
    bool $isSearchable = false,
    Closure|array $items = [],
    string $placement = 'bottom-start'
)
</x-code>

<x-ul>
    <li><code>$title</code> - заголовок выпадающего блока,</li>
    <li><code>$toggler</code> - переключатель,</li>
    <li><code>$content</code> - контент,</li>
    <li><code>$isSearchable</code> - поиск по элементам,</li>
    <li><code>$items</code> - элементы блока,</li>
    <li><code>$placement</code> - расположение выпадающего блока.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    title: 'Title',
    toggler: 'Click me',
    items: [
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ],
    placement: 'top',
) // [tl! focus:-9]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    title: 'Title',
                    toggler: 'Click me',
                    items: [
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ],
                    placement: 'top',
                )
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="toggler">Переключатель</x-sub-title>

<x-p>
    Метод <code>toggler()</code> позволяет указать элемент, по клику на который будет раскрываться <code>Dropdown</code>.
</x-p>

<x-code language="php">
toggler(Closure|string $toggler)
</x-code>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Dropdown;

Dropdown::make(
    title: 'Dropdown',
    content: fn() => fake()->text()
)
    ->toggler(fn() => ActionButton::make('Click me')) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    title: 'Dropdown',
                    toggler: fn() => MoonShine\ActionButtons\ActionButton::make('Click me'),
                    content: fn() => '<div class="m-4">' . fake()->text() . '</div>'
                )
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="items">Элементы</x-sub-title>

<x-p>
    Метод <code>items()</code> позволяет добавить элементы в раскрывающийся список.
</x-p>

<x-code language="php">
items(Closure|array $items)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ]) // [tl! focus:-4]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="searchable">Поиск по элементам</x-sub-title>

<x-p>
    Метод <code>searchable()</code> позволяет добавить поиск по элементам в раскрывающем блоке.
</x-p>

<x-code language="php">
searchable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable() // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                    ->searchable()
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-moonshine::divider label="Placeholder" />

<x-p>
    Метод <code>searchPlaceholder()</code> позволяет изменить placeholder в поле поиска.
</x-p>

<x-code language="php">
searchPlaceholder(Closure|string $placeholder)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable()
    ->searchPlaceholder('Search item') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                    ->searchable()
                    ->searchPlaceholder('Search item')
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="content">Контент</x-sub-title>

<x-p>
    Метод <code>content()</code> позволяет позволяет отобразить в раскрывающем блоке произвольный контент.
</x-p>

<x-code language="php">
content(Closure|View|string $content)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
)
    ->content(fake()->text()) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->content('<div class="m-4">' . fake()->text() . '</div>')
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="placement">Расположение</x-sub-title>

<x-p>
    Метод <code>placement()</code> позволяет изменить расположение выпадающего блока.
</x-p>

<x-code language="php">
placement(string $placement)
</x-code>

@include('pages.ru.ui.shared.placement')

<x-code language="php">
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
    content: fake()->text(),
)
    ->placement('right') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                    content: '<div class="m-4">' . fake()->text() . '</div>',
                )
                    ->placement('right')
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        О дополнительных вариантах расположения можно узнать из официальной документации
        <x-link link="https://atomiks.github.io/tippyjs/v6/all-props/#placement" target="_blank">tippy.js</x-link>.
    </x-moonshine::alert>
</x-p>

</x-page>
