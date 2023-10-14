<x-page title="Modal" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#wide', 'label' => 'Широкое окно'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания модальных окон используется компонент <code>moonshine::modal</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal.blade.php"></x-code>

@include("examples/components/modal")

<x-sub-title id="wide">Широкое окно</x-sub-title>

<x-p>
    Параметр <code>wide</code> позволяет модальным окнам занимать всю ширину.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-wide.blade.php"></x-code>

@include("examples/components/modal-wide")

</x-page>
