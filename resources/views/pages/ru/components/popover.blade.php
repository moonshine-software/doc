<x-page title="Popover" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without', 'label' => 'Без компонента'],
    ]
]">
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    C помощью компонента <code>moonshine::popover</code> можно создать всплывающее окно
</x-p>

@include('pages.ru.components.shared.placement')

<x-code language="blade" file="resources/views/examples/components/popover.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/popover")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="without">Без использования компонента</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/popover-without.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/popover-without")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
