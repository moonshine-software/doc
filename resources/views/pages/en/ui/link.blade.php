<x-page title="Link" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#filled', 'label' => 'Fill'],
        ['url' => '#icon', 'label' => 'Icon'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create a stylized link, you can use the <code>moonshine::link-button</code> components
    or <code>moonshine::link-native</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/link.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="filled">Fill</x-sub-title>

<x-p>
    The <code>filled</code> parameter is responsible for filling.
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-filled.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-filled")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    You can pass the <code>icon</code> parameter.
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-icon.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-icon")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-moonshine::alert type="default" icon="heroicons.book-open" class="mt-8">
    All available <x-link link="{{ to_page('icons') }}">icons</x-link>.
</x-moonshine::alert>

</x-page>
