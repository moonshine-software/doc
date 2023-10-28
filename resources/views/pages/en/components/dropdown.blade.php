<x-page title="Dropdown" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#title', 'label' => 'Title'],
        ['url' => '#footer', 'label' => 'Footer'],
        ['url' => '#placement', 'label' => 'Placement'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::dropdown</code> component, you can create dropdown blocks
</x-p>

<x-code language="blade" file="resources/views/examples/components/dropdown.blade.php"></x-code>

@include("examples/components/dropdown")

<x-sub-title id="title">Title</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-title.blade.php"></x-code>

@include("examples/components/dropdown-title")

<x-sub-title id="footer">Footer</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/dropdown-footer.blade.php"></x-code>

@include("examples/components/dropdown-footer")

<x-sub-title id="placement">Placement</x-sub-title>

@include('pages.en.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/dropdown-placement.blade.php"></x-code>

@include("examples/components/dropdown-placement")

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        For additional location options, see the official documentation
        <x-link link="https://atomiks.github.io/tippyjs/v6/all-props/#placement" target="_blank">tippy.js</x-link>
    </x-moonshine::alert>
</x-p>

</x-page>
