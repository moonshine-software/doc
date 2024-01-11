<x-p>
    Метод <code>creatable()</code> позволяет создавать новый объект отношения через модальное окно.
</x-p>

<x-code language="php">
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->creatable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/' . str($field)->snake('_')->append('_creatable.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($field)->snake('_')->append('_creatable_dark.png')) }}"></x-image>

<x-p>
    Кастомизировать кнопку создания можно передав методу параметр <em>button</em>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>
