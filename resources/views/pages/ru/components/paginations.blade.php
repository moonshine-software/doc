<x-page title="Paginations" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#simple', 'label' => 'Упрощенная пагинация'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компонент <code>moonshine::pagination</code> позволяет создать стилизованную пагинацию по страницам.<br>
    Для этого добавьте компонент в blade view пагинации.
</x-p>

<x-code language="blade" file="resources/views/examples/components/pagination.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/pagination-mock")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="simple">Упрощенная пагинация</x-sub-title>

<x-p>
    Параметр <code>simple</code> со значением <code>TRUE</code> позволяет отобразить пагинацию в упрощенном виде.
</x-p>

<x-code language="blade" file="resources/views/examples/components/pagination-simple.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/pagination-mock", ['simple' => true])
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
