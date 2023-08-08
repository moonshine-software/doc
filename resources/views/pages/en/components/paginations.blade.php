<x-page title="Paginations" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#simple', 'label' => 'Simple pagination'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::pagination</code> component allows you to create a stylized page-by-page pagination.<br>
    To do this, add a component to the pagination blade view.
</x-p>

<x-code language="blade" file="resources/views/examples/components/pagination.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/pagination-mock")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="simple">Simple pagination</x-sub-title>

<x-p>
    The <code>simple</code> parameter with the value <code>TRUE</code> allows you to display the pagination in a simplified way.
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
