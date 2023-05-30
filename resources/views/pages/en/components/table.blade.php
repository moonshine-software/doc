<x-page title="Table" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#crud', 'label' => 'Crud mode'],
        ['url' => '#notfound', 'label' => 'Not found'],
        ['url' => '#slots', 'label' => 'Slots'],
        ['url' => '#styles', 'label' => 'Styles'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Styled tables can be created using the <code>moonshine::table</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="crud">Crud mode</x-sub-title>

<x-p>
    The <code>crudMode</code> parameter allows you to additionally style tables
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-crud.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table-crud")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="notfound">Not found</x-sub-title>

<x-p>
    The <code>notfound</code> parameter allows you to display a message if there are no table elements
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-notfound")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="slots">Slots</x-sub-title>

<x-p>
    The table can be formed using slots
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-slots")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="styles">Styles</x-sub-title>

<x-p>
    To style the table, there are predefined classes that can be used for <code>tr</code> / <code>td</code>
</x-p>

<x-p>
    Available classes:
</x-p>

<x-p class="flex flex-wrap gap-2">
    <x-moonshine::badge color="purple">bgc-purple</x-moonshine::badge>
    <x-moonshine::badge color="pink">bgc-pink</x-moonshine::badge>
    <x-moonshine::badge color="blue">bgc-blue</x-moonshine::badge>
    <x-moonshine::badge color="green">bgc-green</x-moonshine::badge>
    <x-moonshine::badge color="yellow">bgc-yellow</x-moonshine::badge>
    <x-moonshine::badge color="red">bgc-red</x-moonshine::badge>
    <x-moonshine::badge color="gray">bgc-gray</x-moonshine::badge>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-slots-color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
