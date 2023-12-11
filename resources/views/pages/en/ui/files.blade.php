<x-page title="Files" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#without-download', 'label' => 'No download'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To display a list of files, you can use the <code>moonshine::files</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/files.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/files")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without-download">No download</x-sub-title>

<x-p>
    To disable the ability to download files, you need the component
    pass the <code>download</code> parameter with the value <code>FALSE</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/files-no-download.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/files-no-download")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
