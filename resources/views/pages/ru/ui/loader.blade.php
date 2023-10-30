<x-page title="Loader" :sectionMenu="[]">

<x-p>
    Компонент <code>moonshine::loader</code> позволяет создать стилизованный индикатор загрузки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/loader.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/loader")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
