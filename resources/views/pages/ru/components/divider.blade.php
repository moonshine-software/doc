<x-page title="Divider" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#text', 'label' => 'Текстовый разделитель'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компонент <code>moonshine::divider</code> позволяет создать стилизованный разделитель контента
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="text">Текстовый разделитель</x-sub-title>

<x-p>
    В качестве разделителя можно использовать текст, для этого необходимо указать текст в параметре <code>label</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider-label.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider-label")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    Параметр <code>centered</code> позволяет разместить текст по центру
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider-label-center.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider-label-center")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
