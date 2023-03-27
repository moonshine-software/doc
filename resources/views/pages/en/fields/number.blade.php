<x-page title="Number">

<x-p>
    Input с типом number and additional methods  <code>stars</code>, <code>min</code>, <code>min</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Number;

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
    To display a numerical value in the form of stars (e.g. for rating), you need the method  <code>stars</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Number;

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



