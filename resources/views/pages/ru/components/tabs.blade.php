<x-page title="Tabs" :sectionMenu="[]">

<x-p>
    Для создания вкладок можно воспользоваться компонентом <code>moonshine::tabs</code>
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
