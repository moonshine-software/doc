<x-sub-title id="placeholder">Placeholder</x-sub-title>

<x-p>
    The <code>placeholder()</code> method allows you to set the <em>placeholder</em> attribute to a field.
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
