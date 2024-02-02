<x-page title="Template">

<x-p>
    <em>Template</em> не имеет какой-либо готовой реализации и
    позволяет конструировать поле используя <em>fluent interface</em> в процессе объявление.
</x-p>

<x-code language="php">
use MoonShine\Fields\Template; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Template::make('MyField')
            ->setLabel('My Field')
            ->fields([
                Text::make('Title')
            ]) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Рецепт: <x-link link="{{ to_page('recipes') }}#hasone-through-template">HasOne отношение через поле Template</x-link>.
</x-moonshine::alert>

</x-page>
