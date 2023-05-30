<x-page title="Rating" :sectionMenu="[]">

<x-p>
    The <code>moonshine::rating</code> component allows you to create stylized ratings
</x-p>

<x-code language="blade" file="resources/views/examples/components/rating.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/rating")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
