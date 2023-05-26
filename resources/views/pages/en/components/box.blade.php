<x-page title="Box" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#title', 'label' => 'Title'],
        ['url' => '#dark', 'label' => 'Dark style'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To highlight content, you can use the <code>moonshine::box</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/box.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="title">Title</x-sub-title>

<x-p>
    The <code>title</code> parameter sets the title of the block
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-title.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-title")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="dark">Dark style</x-sub-title>

<x-p>
    You can set a dark style for a block by specifying the <code>dark</code> parameter with the value <code>TRUE</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-dark.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-dark")
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
