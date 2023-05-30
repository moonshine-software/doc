<x-page title="Progress bar" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#radial', 'label' => 'Радиальный'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компонент <code>moonshine::progress-bar</code> позволяет создавать индикатор прогресса
</x-p>

@include('pages.ru.components.shared.colors')

<x-code language="blade" file="resources/views/examples/components/progress_bar.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/progress_bar")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="radial">Радиальный</x-sub-title>

<x-p>
    Для создания радиального индикатора прогресса необходимо компоненту передать параметр <code>radial</code> со значением <code>TRUE</code>
</x-p>

@include('pages.ru.components.shared.sizes')

<x-code language="blade" file="resources/views/examples/components/progress_bar-radial.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/progress_bar-radial")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
