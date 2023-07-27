<x-page title="Offcanvas" :sectionMenu="[]">

<x-p>
    Компонент <code>moonshine::offcanvas</code> позволяет создать боковые панели.
</x-p>

<x-code language="blade" file="resources/views/examples/components/offcanvas.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/offcanvas")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
