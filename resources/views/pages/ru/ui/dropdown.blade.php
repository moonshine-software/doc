<x-page title="Dropdown" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#title', 'label' => 'Заголовок'],
        ['url' => '#footer', 'label' => 'Footer'],
        ['url' => '#placement', 'label' => 'Расположение'],
    ]
]">
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    C помощью компонента <code>moonshine::dropdown</code> можно создавать выпадающие блоки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/dropdown.blade.php"></x-code>

@include("examples/components/dropdown")

<x-sub-title id="title">Заголовок</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-title.blade.php"></x-code>

@include("examples/components/dropdown-title")

<x-sub-title id="footer">Footer</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-footer.blade.php"></x-code>

@include("examples/components/dropdown-footer")

<x-sub-title id="placement">Расположение</x-sub-title>

@include('pages.ru.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/dropdown-placement.blade.php"></x-code>

@include("examples/components/dropdown-placement")

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        О дополнительных вариантах расположения можно узнать из официальной документации
        <x-link link="https://atomiks.github.io/tippyjs/v6/all-props/#placement" target="_blank">tippy.js</x-link>.
    </x-moonshine::alert>
</x-p>

</x-page>
