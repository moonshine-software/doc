<x-page title="Box" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#title', 'label' => 'Heading'],
        ['url' => '#dark', 'label' => 'Dark style'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To highlight content, you can use the <code>moonshine::box</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/box.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="title">Heading</x-sub-title>

<x-p>
    The <code>title</code> parameter sets the block title.
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-title.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-title")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="dark">Dark style</x-sub-title>

<x-p>
    You can set a dark style for a block by specifying the <code>dark</code> parameter with a value of <code>TRUE</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-dark.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-dark")
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
