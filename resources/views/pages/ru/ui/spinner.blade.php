<x-page title="Spinner" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#size', 'label' => 'Размер'],
        ['url' => '#color', 'label' => 'Цвет'],
        ['url' => '#position', 'label' => 'Позиционирование'],
    ]
]">
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    C помощью компонента <code>moonshine::spinner</code> можно создавать индикаторы загрузки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/spinner")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="size">Размер</x-sub-title>

@include('pages.ru.ui.shared.sizes')

<x-code language="blade" file="resources/views/examples/components/spinner-size.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex gap-2">
            @include("examples/components/spinner-size")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="color">Цвет</x-sub-title>

@include('pages.ru.ui.shared.themes-colors')

<x-code language="blade" file="resources/views/examples/components/spinner-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex gap-2">
            @include("examples/components/spinner-color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="position">Позиционирование</x-sub-title>

<x-p>
    Параметр <code>absolute="true"</code> задает абсолютное позиционирование индикатора загрузки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner-absolute.blade.php"></x-code>

<x-p>
    Параметр <code>fixed="true"</code> задает фиксированное позиционирование индикатора загрузки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/spinner-fixed.blade.php"></x-code>

</x-page>
