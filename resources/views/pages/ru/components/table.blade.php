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
    Стилизованные таблицы можно создавать с помощью компонента <code>moonshine::table</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::card>
            @include("examples/components/table")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="crud">Crud режим</x-sub-title>

<x-p>
    Параметр <code>crudMode</code> позволяет дополнительно стилизовать таблицы
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-crud.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::card>
            @include("examples/components/table-crud")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="notfound">Отсутствие элементов</x-sub-title>

<x-p>
    Параметр <code>notfound</code> позволяет выводить сообщение при отсутствии элементов таблицы
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::card>
            @include("examples/components/table-notfound")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="slots">Слоты</x-sub-title>

<x-p>
    Таблицу можно сформировать с использованием слотов
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::card>
            @include("examples/components/table-slots")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="styles">Стилизация</x-sub-title>

<x-p>
    Для стилизации таблицы есть предустановленные классы, которые можно использовать для tr/td
</x-p>

<x-p>
    Доступные классы: <code>bgc-green</code>, <code>bgc-blue</code>, <code>bgc-red</code>, <code>bgc-pink</code>,
    <code>bgc-gray</code>, <code>bgc-purple</code>, <code>bgc-yellow</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots-color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="8">
        <x-moonshine::card>
            @include("examples/components/table-slots-color")
        </x-moonshine::card>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
