<x-sub-title id="readonly">Only for reading</x-sub-title>

<x-p>
    If the field is read-only, then you must use the <code>readonly()</code> method.
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
