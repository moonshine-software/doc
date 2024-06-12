
<x-page title="Carousel" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#portrait', 'label' => 'Портретная ориентация'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компонент <code>moonshine::carousel</code> используется для создания карусели изображений .
</x-p>

<x-code language="blade" file="resources/views/examples/components/carousel.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/carousel")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>
<x-sub-title id="portrait">Портретная ориентация</x-sub-title>
<x-p>
    Для использования карусели с вертикальными изображениями передать параметр <code>:portrait="true"</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/carousel-portrait.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/carousel-portrait")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>
</x-page>
