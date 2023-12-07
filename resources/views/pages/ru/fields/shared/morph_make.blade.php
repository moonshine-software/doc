<x-p>
    Для создания данного поля используется статический метод <code>make()</code>.
</x-p>

<x-code language="php">
{{ $field }}::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
</x-code>

<x-p>
    <code>$label</code> - лейбл, заголовок поля,<br>
    <code>$relationName</code> - название отношения,<br>
    <code>$formatted</code> - замыкание или поле в связанной таблице для отображения значений.
</x-p>

@if($field === 'MorphMany')
<x-moonshine::alert type="error" icon="heroicons.information-circle">
    Параметр <code>$formatted</code> не используется в поле <code>MorphMany</code>!
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
