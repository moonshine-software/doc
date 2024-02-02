<x-page title="Template">

<x-p>
    <em>Template</em> does not have any ready-made implementation and
    allows you to construct a field using <em>fluent interface</em> during the declaration process.
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
    Recipe: <x-link link="{{ to_page('recipes') }}#hasone-through-template">HasOne relationship through the Template field</x-link>.
</x-moonshine::alert>

</x-page>
