<x-page title="MorphOne">

<x-extendby :href="route('moonshine.page', 'fields-has_one')">
    HasOne
</x-extendby>

<x-p>Поле для отношений в Laravel типа morphOne</x-p>

<x-p>
    То же самое что и <code>MoonShine\Fields\Relationships\HasOne</code> только для отношений MorphOne
    <code>MoonShine\Fields\Relationships\MorphOne</code>
</x-p>

@include('pages.ru.fields.shared.morph_make', ['field' => 'MorphOne', 'label' => 'Profile'])

</x-page>



