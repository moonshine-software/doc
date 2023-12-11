<x-page title="Dropdown" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#title', 'label' => 'Heading'],
        ['url' => '#footer', 'label' => 'Footer'],
        ['url' => '#placement', 'label' => 'Location'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::dropdown</code> component you can create drop-down blocks.
</x-p>

<x-code language="blade" file="resources/views/examples/components/dropdown.blade.php"></x-code>

@include("examples/components/dropdown")

<x-sub-title id="title">Heading</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-title.blade.php"></x-code>

@include("examples/components/dropdown-title")

<x-sub-title id="footer">Footer</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-footer.blade.php"></x-code>

@include("examples/components/dropdown-footer")

<x-sub-title id="placement">Location</x-sub-title>

@include('pages.ru.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/dropdown-placement.blade.php"></x-code>

@include("examples/components/dropdown-placement")

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Additional location options can be found in the official documentation
        <x-link link="https://atomiks.github.io/tippyjs/v6/all-props/#placement" target="_blank">tippy.js</x-link>.
    </x-moonshine::alert>
</x-p>

</x-page>
