<x-page title="Paginations" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#simple', 'label' => 'Simplified pagination'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::pagination</code> component allows you to create stylized pagination across pages.<br>
    To do this, add a component to the blade view of the pagination.
</x-p>

<x-code language="blade" file="resources/views/examples/components/pagination.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/pagination-mock")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="simple">Simplified pagination</x-sub-title>

<x-p>
    The <code>simple</code> parameter with the value <code>TRUE</code> allows you to display pagination in a simplified form.
</x-p>

<x-code language="blade" file="resources/views/examples/components/pagination-simple.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/pagination-mock", ['simple' => true])
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
