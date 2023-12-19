<x-p>
    To create this field, use the static <code>make()</code> method.
</x-p>

<x-code language="php">
{{ $field }}::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
</x-code>

<x-ul>
    <li><code>$label</code> - label, field header,</li>
    <li><code>$relationName</code> - name of the relationship</li>
    <li><code>$formatted</code> - a closure or field in a related table to display values.</li>
</x-ul>

@if($field === 'MorphMany')
<x-moonshine::alert type="error" icon="heroicons.information-circle">
    The <code>$formatted</code> parameter is not used in the <code>MorphMany</code> field!
</x-moonshine::alert>
@endif

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->lower() }}') // [tl! focus]
    ];
}

//...
</x-code>
