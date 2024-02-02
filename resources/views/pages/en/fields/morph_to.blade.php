<x-page title="MorphTo">

<x-extendby :href="to_page('fields-belongs_to')">
    BelongsTo
</x-extendby>

<x-p>MorphTo relationship field in Laravel</x-p>

<x-p>Same as <code>MoonShine\Fields\Relationships\BelongsTo</code> only for MorphTo relationships</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\MorphTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        MorphTo::make('Commentable')->types([
            Article::class => 'title'
        ]), // [tl! focus:-2]
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Required <code>types</code> method indicating the available classes.<br/>
    The key is a reference to the model, and the value is the field to display.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/morph_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_dark.png') }}"></x-image>

</x-page>
