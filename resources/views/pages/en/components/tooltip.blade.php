<x-page title="Tooltip" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#without', 'label' => 'Without use component'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::tooltip</code> component, you can create handy tooltips
</x-p>

@include('pages.ru.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/tooltip.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/tooltip")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without">Without use component</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/tooltip-without.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/tooltip-without")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
