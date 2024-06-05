@props([
    'label' => $field === 'BelongsToMany' ? 'Countries' : 'Country',
    'placeholder' => $field === 'BelongsToMany' ? 'Countries' : 'Country',
])
<x-sub-title id="placeholder">Placeholder</x-sub-title>

<x-p>
    Метод <code>placeholder()</code> позволяет задать у поля атрибут <em>placeholder</em>.
</x-p>

<x-code language="php">
placeholder(string $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\{!! ($field === 'BelongsTo' || $field === 'BelongsToMany') ? 'Relationships\\' : '' !!}{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->snake() }}')
            ->nullable()
            ->placeholder('{{ $placeholder }}') // [tl! focus]
    ];
}

//...
</x-code>
