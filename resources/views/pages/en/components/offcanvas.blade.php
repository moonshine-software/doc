<x-page title="Offcanvas" :sectionMenu="[]">

<x-p>
    The <code>moonshine::offcanvas</code> component allows you to create sidebars.
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
