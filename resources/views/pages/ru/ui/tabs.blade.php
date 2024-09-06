<x-page title="Tabs" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#active', 'label' => 'Активная вкладка'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для создания вкладок можно воспользоваться компонентом <code>moonshine::tabs</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/tabs.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/tabs")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-moonshine::divider label="Через slots" />

<x-code language="blade" file="resources/views/examples/components/tabs-slots.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/tabs-slots")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="active">Активная вкладка</x-sub-title>

<x-p>
    Указать активную вкладку по умолчанию, можно задав <code>active</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/tabs-active.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/tabs-active")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
