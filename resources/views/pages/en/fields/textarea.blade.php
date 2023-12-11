<x-page
    title="Textarea"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#default', 'label' => 'Default value'],
        ]
    ]"
>

<x-p>
    The <em>Textarea</em> field includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Textarea; // [tl! focus]

//...

public function fields(): array
{
    return [
        Textarea::make('Text') // [tl! focus]
    ];
}

//...
</x-code>


<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Text')
            ->default('...') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
