<x-recipe id="tinymce-limit-preview" title="{{ $title ?? 'Рецепт' }}">

<x-p>
    Иногда необходимо отобразить поле <em>TinyMce</em> в превью с ограниченным числом символов,
    для этого можно воспользоваться методом <code>changePreview()</code>.
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
