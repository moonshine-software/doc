<x-page title="Grid" :sectionMenu="[]">

<x-p>
    To arrange elements on the page, you can use <code>moonshine::grid</code>
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
    <code>adaptiveColSpan</code> - the number of columns that the block occupies for screen sizes up to 1280px.<br>
    <code>colSpan</code> - the number of columns that the block occupies for screen sizes of 1280px or more.
</x-p>

</x-page>
