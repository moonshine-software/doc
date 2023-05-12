<x-page title="Card" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#overlay', 'label' => 'Overlay режим'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания карточек в админ-панели используется компонент <code>moonshine::card</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/card.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <div class="mb-6">
            @include("examples/components/card")
        </div>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="overlay">Overlay режим</x-sub-title>

<x-p>
    Для карточки доступен режим <code>overlay</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/card-overlay.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <div class="mb-6">
            @include("examples/components/card-overlay")
        </div>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
