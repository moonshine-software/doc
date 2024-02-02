<x-page title="MorphToMany">

<x-extendby :href="to_page('fields-belongs_to_many')">
    BelongsToMany
</x-extendby>

<x-p>MorphToMany relationship field in Laravel</x-p>

<x-p>
    Same as <code>MoonShine\Fields\Relationships\BelongsToMany</code> only for MorphToMany relationships
    <code>MoonShine\Fields\Relationships\MorphToMany</code>
</x-p>

@include('pages.en.fields.shared.morph_make', ['field' => 'MorphToMany', 'label' => 'Categories'])

</x-page>



