<x-page title="Grid" :sectionMenu="[]">

<x-p>
    You can use <code>moonshine::grid</code> to arrange elements on the page
    and <code>moonshine::column</code> components.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The grid consists of 12 columns.
</x-moonshine::alert>

<x-code language="blade" file="resources/views/examples/components/grid.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/grid")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    <code>adaptiveColSpan</code> - the number of columns that occupy the block when the screen size is up to 1280 pixels.<br>
    <code>colSpan</code> - the number of columns that occupy a block with a screen size of 1280px.
</x-p>

</x-page>
