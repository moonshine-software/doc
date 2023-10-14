<x-page title="Badge" :sectionMenu="[]">

<x-p>
    Если вам необходимо разместить значок на странице, то
    воспользуйтесь компонентом <code>moonshine::badge</code>.
</x-p>

<x-p>
    Доступны следующие значки:
</x-p>

<x-code language="blade" file="resources/views/examples/components/badge.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box class="flex flex-wrap gap-2">
            @include("examples/components/badge")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
