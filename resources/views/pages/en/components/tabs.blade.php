<x-page title="Tabs" :sectionMenu="[]">

<x-p>
    To create tabs, you can use the <code>moonshine::tabs</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/tabs.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::card>
            @include("examples/components/tabs")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
