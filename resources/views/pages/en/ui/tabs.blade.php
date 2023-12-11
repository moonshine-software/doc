<x-page title="Tabs" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#active', 'label' => 'Active tab'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create tabs, you can use the <code>moonshine::tabs</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/tabs.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/tabs")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="active">Active tab</x-sub-title>

<x-p>
    You can specify the default active tab by specifying <code>active</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/tabs-active.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/tabs-active")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
