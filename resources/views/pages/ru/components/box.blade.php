<x-page title="Box" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#title', 'label' => 'Заголовок'],
        ['url' => '#dark', 'label' => 'Темный стиль'],
    ]
]">
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для выделения контентам можно воспользоваться компонентом <code>moonshine::box</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/box.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="title">Заголовок</x-sub-title>

<x-p>
    Через параметр <code>title</code> задается заголовок блока
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-title.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-title")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="dark">Темный стиль</x-sub-title>

<x-p>
    Задать темный стиль для блока можно указав параметр <code>dark</code> со значением <code>TRUE</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/box-dark.blade.php" />

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        @include("examples/components/box-dark")
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
