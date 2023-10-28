<x-page title="Tooltip" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without', 'label' => 'Без компонента'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    C помощью компонента <code>moonshine::tooltip</code> можно создавать удобные подсказки.
</x-p>

@include('pages.ru.ui.shared.placement')

<x-code language="blade" file="resources/views/examples/components/tooltip.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/tooltip")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without">Без использования компонента</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/tooltip-without.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/tooltip-without")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
