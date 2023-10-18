<x-page title="Table" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#simple', 'label' => 'Упрощенный вид'],
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


</x-page>
