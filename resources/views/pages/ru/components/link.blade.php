<x-page title="Link" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#filled', 'label' => 'Заливка'],
        ['url' => '#icon', 'label' => 'Иконка'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания стилизованной ссылки можно воспользоваться компонентами <code>moonshine::link</code>
    или <code>moonshine::link-native</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/link.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="filled">Заливка</x-sub-title>

<x-p>
    Параметр <code>filled</code> отвечает за заливку:
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-filled.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-filled")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Можно передать параметр <code>icon</code>:
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-icon.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-icon")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
