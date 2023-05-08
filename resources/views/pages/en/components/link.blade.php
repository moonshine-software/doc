<x-page title="Link" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#filled', 'label' => 'Filled'],
        ['url' => '#icon', 'label' => 'Icon'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create a stylized link, you can use the <code>moonshine::link</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/link.blade.php"></x-code>

@include("examples/components/link")

<x-sub-title id="filled">Filled</x-sub-title>

<x-p>
    The <code>filled</code> parameter is responsible for filling
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-filled.blade.php"></x-code>

@include("examples/components/link-filled")

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    You can pass the parameter <code>icon</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-icon.blade.php"></x-code>

@include("examples/components/link-icon")

</x-page>
