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
        {{ $field }}::make({!! $field === 'BelongsToMany' ? "'Countries'" : "'Country'" !!}, {!! $field === 'BelongsToMany' ? "'countries'" : "'country'" !!})
            ->nullable()
            ->placeholder('{!! $field === 'BelongsToMany' ? 'Countries' : 'Country' !!}') // [tl! focus]
    ];
}

//...
</x-code>
