<x-page title="Grid" :sectionMenu="[]">

<x-p>
    Для расположения элементов на странице можно воспользоваться <code>moonshine::grid</code>
    и <code>moonshine::column</code> компонентами.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Сетка состоит из 12 столбцов.
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
    <code>adaptiveColSpan</code> - количество столбцов, которые занимает блок при размерах экрана до 1280px.<br>
    <code>colSpan</code> - количество столбцов, которые занимает блок при размерах экрана от 1280px.
</x-p>

</x-page>
