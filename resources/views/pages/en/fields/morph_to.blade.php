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

<x-image theme="light" src="{{ asset('screenshots/morph_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_dark.png') }}"></x-image>
<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Required <code>types</code> method indicating the available classes.<br/>
</x-moonshine::alert>

<x-p>Description of the value of the <code>types</code> method:</x-p>
<x-p>The key is a reference to the model<br>
The value is a string or an array.
<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the value is passed as a string, it should indicate the name of the field to be displayed. If it is passed as an array, then the first element of the array is the name of the field to display, and the second is the name of the relationship instead of the name of the model.
</x-moonshine::alert>
</x-p>

<x-code>
use MoonShine\Fields\Relationships\MorphTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        MorphTo::make('Imageable')->types([
            Company::class => ['short_name', 'Organization']
        ]), // [tl! focus:-2]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/morph_to_array.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_array_dark.png') }}"></x-image>

</x-page>
