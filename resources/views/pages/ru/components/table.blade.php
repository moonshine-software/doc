<x-page title="Table" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#crud', 'label' => 'Crud режим'],
        ['url' => '#notfound', 'label' => 'Отсутствие элементов'],
        ['url' => '#slots', 'label' => 'Слоты'],
        ['url' => '#styles', 'label' => 'Стилизация'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Стилизованные таблицы можно создавать с помощью компонента <code>moonshine::table</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="crud">Crud режим</x-sub-title>

<x-p>
    Параметр <code>crudMode</code> позволяет дополнительно стилизовать таблицы.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-crud.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        @include("examples/components/table-crud")
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="notfound">Отсутствие элементов</x-sub-title>

<x-p>
    Параметр <code>notfound</code> позволяет выводить сообщение при отсутствии элементов таблицы.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-notfound")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="slots">Слоты</x-sub-title>

<x-p>
    Таблицу можно сформировать с использованием слотов.
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-slots")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="styles">Стилизация</x-sub-title>

<x-p>
    Для стилизации таблицы есть предустановленные классы, которые можно использовать для <code>tr</code> / <code>td</code>.
</x-p>

<x-p>
    Доступные классы:
</x-p>

<x-p class="flex flex-wrap gap-2">
    <x-moonshine::badge color="purple">bgc-purple</x-moonshine::badge>
    <x-moonshine::badge color="pink">bgc-pink</x-moonshine::badge>
    <x-moonshine::badge color="blue">bgc-blue</x-moonshine::badge>
    <x-moonshine::badge color="green">bgc-green</x-moonshine::badge>
    <x-moonshine::badge color="yellow">bgc-yellow</x-moonshine::badge>
    <x-moonshine::badge color="red">bgc-red</x-moonshine::badge>
    <x-moonshine::badge color="gray">bgc-gray</x-moonshine::badge>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::box>
            @include("examples/components/table-slots-color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
