<x-page title="Thumbnails" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#multiple', 'label' => 'Group of images'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create thumbnails, you can use the <code>moonshine::thumbnails</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/thumbnails")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    You can also specify the <code>alt</code> attribute.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-alt.blade.php"></x-code>

<x-sub-title id="multiple">Group of images</x-sub-title>

<x-p>
    You can pass an array of images to the component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-multiple.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/thumbnails-multiple")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
