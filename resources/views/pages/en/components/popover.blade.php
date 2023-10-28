<x-page title="Popover" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#without', 'label' => 'Without use component'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::popover</code> component, you can create a popup window
</x-p>

@include('pages.ru.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/popover.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/popover")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without">Without use component</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/popover-without.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/popover-without")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
