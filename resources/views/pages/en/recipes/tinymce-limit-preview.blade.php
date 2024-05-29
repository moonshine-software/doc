<x-recipe id="tinymce-limit-preview" title="{{ $title ?? 'Recipe' }}">

<x-p>
    Sometimes it is necessary to display the <em>TinyMce</em> field in the preview with a limited number of characters,
    To do this, you can use the <code>changePreview()</code> method.
</x-p>

<x-code language="php">
public function fields(): array
{
    return [
        TinyMce::make('Description')
            ->changePreview(fn(string $text) => str($text)->stripTags()->limit(10)) // [tl! focus:-1]
    ];
}

//...
}
</x-code>

</x-recipe>
