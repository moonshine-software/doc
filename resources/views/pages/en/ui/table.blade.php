<x-page title="Table" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#simple', 'label' => 'Simplified view'],
        ['url' => '#notfound', 'label' => 'Missing elements'],
        ['url' => '#slots', 'label' => 'Slots'],
        ['url' => '#styles', 'label' => 'Stylization'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Styled tables can be created using the <code>moonshine::table</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="simple">Simplified view</x-sub-title>

<x-p>
    The <code>simple</code> parameter allows you to create a simplified table view.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-simple.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-simple")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="notfound">Missing elements</x-sub-title>

<x-p>
    The <code>notfound</code> parameter allows you to display a message if there are no table elements.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table-notfound")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="slots">Slots</x-sub-title>

<x-p>
    A table can be formed using slots.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table-slots")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="styles">Stylization</x-sub-title>

<x-p>
    To style a table, there are predefined classes that can be used for <code>tr</code> / <code>td</code>.
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
    <x-moonshine::badge color="primary">bgc-primary</x-moonshine::badge>
    <x-moonshine::badge color="secondary">bgc-secondary</x-moonshine::badge>
    <x-moonshine::badge color="success">bgc-success</x-moonshine::badge>
    <x-moonshine::badge color="warning">bgc-warning</x-moonshine::badge>
    <x-moonshine::badge color="error">bgc-error</x-moonshine::badge>
    <x-moonshine::badge color="info">bgc-info</x-moonshine::badge>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table-slots-color")
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
