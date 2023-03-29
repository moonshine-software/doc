<x-page title="Text Box">

<x-p>
    The text field includes all the basic methods
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')  // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
