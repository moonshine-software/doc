<x-page title="Link" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#filled', 'label' => 'Заливка'],
        ['url' => '#icon', 'label' => 'Иконка'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания стилизованной ссылки можно воспользоваться компонентом <code>moonshine::link</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/link.blade.php"></x-code>

@include("examples/components/link")

<x-sub-title id="filled">Заливка</x-sub-title>

<x-p>
    Параметр <code>filled</code> отвечает за заливку
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-filled.blade.php"></x-code>

@include("examples/components/link-filled")

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Можно передать параметр <code>icon</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/link-icon.blade.php"></x-code>

@include("examples/components/link-icon")

</x-page>
