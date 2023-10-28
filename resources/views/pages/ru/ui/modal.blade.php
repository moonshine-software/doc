<x-page title="Modal" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#wide', 'label' => 'Широкое окно'],
        ['url' => '#auto', 'label' => 'Автоматическая ширина'],
        ['url' => '#close', 'label' => 'Закрытие окна'],
        ['url' => '#async', 'label' => 'Асинхронный контент'],
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

<x-sub-title id="auto">Автоматическая ширина</x-sub-title>

<x-p>
    Параметр <code>auto</code> позволяет модальным окнам занимать ширину в зависимости от контента.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-auto.blade.php"></x-code>

@include("examples/components/modal-auto")

<x-sub-title id="close">Закрытие окна</x-sub-title>

<x-p>
    По умолчанию модальные окна закрываются при клике вне области окна,
    переопределить такое поведение можно через параметр <code>closeOutside</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-close.blade.php"></x-code>

@include("examples/components/modal-close")

<x-sub-title id="async">Асинхронный контент</x-sub-title>

<x-p>
    Компонент <code>moonshine::modal</code> позволяет асинхронно загружать контент.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-async.blade.php"></x-code>

@include("examples/components/modal-async")

</x-page>
