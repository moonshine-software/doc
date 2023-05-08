<x-page title="Table" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#crud', 'label' => 'Crud режим'],
        ['url' => '#notfound', 'label' => 'Отсутствие элементов'],
        ['url' => '#slots', 'label' => 'Слоты'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Стилизованные таблицы можно создавать с помощью компонента <code>moonshine::table</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/table.blade.php"></x-code>

@include("examples/components/table")

<x-sub-title id="crud">Crud режим</x-sub-title>

<x-p>
    Параметр <code>crudMode</code> позволяет дополнительно стилизовать таблицы
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-crud.blade.php"></x-code>

@include("examples/components/table-crud")

<x-sub-title id="notfound">Отсутствие элементов</x-sub-title>

<x-p>
    Параметр <code>notfound</code> позволяет выводить сообщение при отсутствии элементов таблицы
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-notfound.blade.php"></x-code>

@include("examples/components/table-notfound")

<x-sub-title id="slots">Слоты</x-sub-title>

<x-p>
    Таблицу можно сформировать с использованием слотов
</x-p>

<x-code language="blade" file="resources/views/examples/components/table-slots.blade.php"></x-code>

@include("examples/components/table-slots")

</x-page>
