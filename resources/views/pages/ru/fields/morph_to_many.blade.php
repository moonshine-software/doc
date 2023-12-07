<x-page title="MorphToMany">

<x-extendby :href="route('moonshine.page', 'fields-belongs_to_many')">
    BelongsToMany
</x-extendby>

<x-p>Поле для отношений в Laravel типа MorphToMany</x-p>

<x-p>
    То же самое что и <code>MoonShine\Fields\Relationships\BelongsToMany</code> только для отношений MorphToMany
    <code>MoonShine\Fields\Relationships\MorphToMany</code>
</x-p>

@include('pages.ru.fields.shared.morph_make', ['field' => 'MorphToMany', 'label' => 'Categories'])

</x-page>



