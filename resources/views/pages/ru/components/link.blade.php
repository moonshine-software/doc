<x-page
    title="Компонент Link"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#icon', 'label' => 'Иконка'],
            ['url' => '#badge', 'label' => 'Значок'],
            ['url' => '#button', 'label' => 'Кнопка'],
            ['url' => '#filled', 'label' => 'Заливка'],
            ['url' => '#tooltip', 'label' => 'Подсказка'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Link</em> позволяет ссылки.
</x-p>

<x-p>
    Создать <em>Link</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Link</code>.
</x-p>

<x-code language="php">
make(Closure|string $href, Closure|string $label = '')
</x-code>

<x-ul>
    <li><code>$href</code> - url ссылки,</li>
    <li><code>$label</code> - заголовок.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Link; // [tl! focus]

//...

public function components(): array
{
    return [
        Link::make(
            '/endpoint',
            'Link'
        ) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Метод <code>icon()</code> позволяет указать иконку у ссылки.
</x-p>

<x-code language="php">
icon(string $icon)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Edit')
    ->icon('heroicons.outline.pencil') // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Edit')->icon('heroicons.outline.pencil') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="badge">Значок</x-sub-title>

<x-p>
    Метод <code>badge()</code> позволяет добавить значок к ссылке.
</x-p>

<x-code language="php">
badge(Closure|string|int|float|null $value)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Comments')
    ->badge(fn() => Comment::count()) // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Comments')->badge(25) !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="button">Кнопка</x-sub-title>

<x-p>
    Метод <code>button()</code> позволяет позволяет отобразить ссылку в виде кнопки.
</x-p>

<x-code language="php">
badge()
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->button() // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link')->button() !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="filled">Заливка</x-sub-title>

<x-p>
    Метод <code>filled()</code> устанавливает заливку для ссылки.
</x-p>

<x-code language="php">
filled()
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->filled() // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-filled")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="tooltip">Подсказка</x-sub-title>

<x-p>
    Метод <code>tooltip()</code> позволяет задать подсказку для ссылки.
</x-p>

<x-code language="php">
tooltip(?string $tooltip = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->tooltip('Tooltip for link') // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link')->tooltip('Tooltip for link') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
