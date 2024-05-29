<x-sub-title id="readonly">Только для чтения</x-sub-title>

<x-p>
    Если поле доступно только для чтения, то необходимо воспользоваться методом <code>readonly()</code>.
</x-p>

<x-code language="php">
readonly(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('Title')
            ->readonly() // [tl! focus]
    ];
}

//...
</x-code>
