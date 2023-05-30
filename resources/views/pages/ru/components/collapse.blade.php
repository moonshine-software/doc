<x-page title="Collapse" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#show', 'label' => 'Отобразить развернутым'],
        ['url' => '#persist', 'label' => 'Сохранение состояния'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Компонент <code>moonshine::collapse</code> позволяет сворачивать контент
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/collapse")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="show">Отобразить развернутым</x-sub-title>

<x-p>
    Если параметр <code>show</code> имеет значение <code>TRUE</code>, то по умолчанию блок будет отображаться развернутым
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse-show.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/collapse-show")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="persist">Сохранение состояния</x-sub-title>

<x-p>
    Если параметр <code>persist</code> имеет значение <code>TRUE</code>, то будет сохраняться состояние блока
</x-p>

<x-code language="blade" file="resources/views/examples/components/collapse-persist.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/collapse-persist")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
