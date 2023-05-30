<x-page title="Badge" :sectionMenu="[]">

<x-p>
    If you need to place a badge on a custom page,
    you can use the <code>moonshine::badge</code> component
</x-p>

<x-p>
    The following badges are available:
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
