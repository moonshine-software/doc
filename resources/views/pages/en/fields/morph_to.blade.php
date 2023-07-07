<x-page title="MorphTo">

<x-extendby :href="route('moonshine.custom_page', 'fields-belongs_to')">
    BelongsTo
</x-extendby>

<x-p>Relationship field in Laravel like MorphTo</x-p>

<x-p>Same as <code>MoonShine\Fields\BelongsTo</code> but for MorphTo relationships</x-p>

<x-code language="php">
use MoonShine\Fields\MorphTo;

//...

public function fields(): array
{
    return [
        MorphTo::make('Commentable')->types([
            Article::class => 'title'
        ]),
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Required <code>types</code> method specifying the classes available.<br/>
    The key is a reference to the model, and the value is the field to display.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/morph_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_dark.png') }}"></x-image>

</x-page>
