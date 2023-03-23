<x-page title="NoInput">

<x-p>
    <b>Поле не предназначено для ввода/изменения данных!</b>
</x-p>

<x-p>
    С помощью данного поля вы можете вывести текстовые данные из любого поля модели,
    либо сгенерировать текст на основе модели.
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('No input field', 'no_input', static fn() => fake()->realText()),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/no-input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/no-input_dark.png') }}"></x-image>


</x-page>
