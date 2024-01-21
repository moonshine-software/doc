<x-page title="Thumbnails" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#multiple', 'label' => 'Группа изображений'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания миниатюр можно воспользоваться компонентом <code>moonshine::thumbnails</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/thumbnails")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    Также можно указать атрибут <code>alt</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-alt.blade.php"></x-code>

<x-sub-title id="multiple">Группа изображений</x-sub-title>

<x-p>
    Компоненту можно передать массив изображений.
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-multiple.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/thumbnails-multiple")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
