<x-page title="Spinner" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#size', 'label' => 'Size'],
        ['url' => '#color', 'label' => 'Color'],
        ['url' => '#position', 'label' => 'Position'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::spinner</code> component, you can create loading indicators
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/spinner")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="size">Size</x-sub-title>

@include('pages.en.ui.shared.sizes')

<x-code language="blade" file="resources/views/examples/components/spinner-size.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex gap-2">
            @include("examples/components/spinner-size")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="color">Color</x-sub-title>

@include('pages.en.ui.shared.colors')

<x-code language="blade" file="resources/views/examples/components/spinner-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex gap-2">
            @include("examples/components/spinner-color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="position">Position</x-sub-title>

<x-p>
    The <code>absolute="true"</code> parameter sets the absolute position of the loading indicator
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner-absolute.blade.php"></x-code>

<x-p>
    The <code>fixed="true"</code> parameter specifies a fixed positioning of the loading indicator
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner-fixed.blade.php"></x-code>

</x-page>
