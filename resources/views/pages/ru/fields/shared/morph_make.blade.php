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

<x-ul>
    <li><code>$label</code> - лейбл, заголовок поля,</li>
    <li><code>$relationName</code> - название отношения,</li>
    <li><code>$formatted</code> - замыкание или поле в связанной таблице для отображения значений.</li>
</x-ul>

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
