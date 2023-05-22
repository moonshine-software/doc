<x-page title="Collapse" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#show', 'label' => 'Show expanded'],
        ['url' => '#persist', 'label' => 'Save state'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::collapse</code> component allows you to collapse content
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::card>
            @include("examples/components/collapse")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="show">Show expanded</x-sub-title>

<x-p>
    If the <code>show</code> parameter is set to <code>TRUE</code>, then by default the block will be displayed expanded
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse-show.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::card>
            @include("examples/components/collapse-show")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="persist">Save state</x-sub-title>

<x-p>
    If the <code>persist</code> parameter is set to <code>TRUE</code>, then the state of the block will be saved
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse-persist.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::card>
            @include("examples/components/collapse-persist")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
