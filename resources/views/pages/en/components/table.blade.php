<x-page title="Table" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#crud', 'label' => 'Crud mode'],
        ['url' => '#notfound', 'label' => 'Not found'],
        ['url' => '#slots', 'label' => 'Slots'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Styled tables can be created using the <code>moonshine::table</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

@include("examples/components/table")

<x-sub-title id="crud">Crud mode</x-sub-title>

<x-p>
    The <code>crudMode</code> parameter allows you to additionally style tables
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-crud.blade.php"></x-code>

@include("examples/components/table-crud")

<x-sub-title id="notfound">Not found</x-sub-title>

<x-p>
    The <code>notfound</code> parameter allows you to display a message if there are no table elements
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

@include("examples/components/table-notfound")

<x-sub-title id="slots">Slots</x-sub-title>

<x-p>
    The table can be formed using slots
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

@include("examples/components/table-slots")

</x-page>
