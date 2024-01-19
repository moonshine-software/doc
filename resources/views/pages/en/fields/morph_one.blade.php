<x-page title="MorphOne">

<x-extendby :href="route('moonshine.page', 'fields-has_one')">
    HasOne
</x-extendby>

<x-p>Relationship field in Laravel of type morphOne</x-p>

<x-p>
    Same as <code>MoonShine\Fields\Relationships\HasOne</code> only for MorphOne relationships
    <code>MoonShine\Fields\Relationships\MorphOne</code>
</x-p>

@include('pages.en.fields.shared.morph_make', ['field' => 'MorphOne', 'label' => 'Profile'])

</x-page>



