<x-page title="Files" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without-download', 'label' => 'Без скачивания'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для вывода списка файлов можно воспользоваться компонентом <code>moonshine::files</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/files.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/files")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without-download">Без скачивания</x-sub-title>

<x-p>
    Чтобы отключить возможность скачивать файлы, необходимо компоненту
    передать параметр <code>download</code> со значением <code>FALSE</code>.
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
