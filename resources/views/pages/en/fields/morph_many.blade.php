<x-page title="MorphMany">

<x-extendby :href="route('moonshine.page', 'fields-has_many')">
    HasMany
</x-extendby>

<x-p>Relationship field in Laravel of type morphMany</x-p>

<x-p>
    Same as <code>MoonShine\Fields\Relationships\HasMany</code> only for morphMany relationships
    <code>MoonShine\Fields\Relationships\MorphMany</code>
</x-p>

@include('pages.en.fields.shared.morph_make', ['field' => 'MorphMany', 'label' => 'Comments'])

</x-page>



