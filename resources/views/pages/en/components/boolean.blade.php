<x-page title="Boolean" :sectionMenu="[]">

<x-p>
    A simple <code>moonshine::boolean</code> component allows you to create an indicator <code>TRUE</code> / <code>FALSE</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/boolean.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::card>
            @include("examples/components/boolean")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-code language="blade" file="resources/views/examples/components/boolean-false.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::card>
            @include("examples/components/boolean-false")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
