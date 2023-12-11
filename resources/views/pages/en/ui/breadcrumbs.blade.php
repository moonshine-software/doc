<x-page title="Breadcrumbs" :sectionMenu="[]">

<x-p>
    The <code>moonshine::breadcrumbs</code> component is used to create <code>breadcrumbs</code> ("breadcrumbs").
</x-p>

<x-code language="blade" file="resources/views/examples/components/breadcrumbs.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/breadcrumbs")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
