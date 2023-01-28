<x-page title="Число">

<x-p>
    Input с типом number и дополнительными методами  <code>stars</code>, <code>min</code>, <code>min</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Рейтинг', 'rating')
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

<x-p>
    Для отображения числового значения в виде звезд (например для рейтинга), необходим метод  <code>stars</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Рейтинг', 'rating')
            ->stars() // [tl! focus]
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

</x-page>



