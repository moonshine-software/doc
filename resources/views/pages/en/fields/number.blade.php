<x-page title="Number">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Input with the number type and additional methods: <code>stars</code>, <code>min</code>, <code>max</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Rating', 'rating')
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

<x-p>
    To display a numerical value as stars (e.g. for rating), you need the <code>stars</code> method
</x-p>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Rating', 'rating')
            ->stars() // [tl! focus]
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

</x-page>
