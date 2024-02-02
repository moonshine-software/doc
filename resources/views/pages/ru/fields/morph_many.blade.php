<x-page title="MorphMany">

<x-extendby :href="to_page('fields-has_many')">
    HasMany
</x-extendby>

<x-p>Поле для отношений в Laravel типа morphMany</x-p>

<x-p>
    То же самое что и <code>MoonShine\Fields\Relationships\HasMany</code> только для отношений morphMany
    <code>MoonShine\Fields\Relationships\MorphMany</code>
</x-p>

@include('pages.ru.fields.shared.morph_make', ['field' => 'MorphMany', 'label' => 'Comments'])

</x-page>



