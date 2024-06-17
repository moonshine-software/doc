
<x-page title="Carousel" :sectionMenu="[
    'Разделы' => [
                ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#portrait', 'label' => 'Portrait orientation'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create image carousel, use the<code>moonshine::carousel</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/carousel.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/carousel")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>
<x-sub-title id="portrait">Portrait orientation</x-sub-title>
<x-p>
    To use a carousel with vertical images, pass the parameter <code>:portrait="true"</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/carousel-portrait.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/carousel-portrait")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>
</x-page>
