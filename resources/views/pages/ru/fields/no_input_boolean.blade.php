<x-page title="NoInput">

<x-p>
    <b>Поле не предназначено для ввода/изменения данных!</b>
</x-p>

<x-p>
    С помощью данного поля вы можете вывести значение <b>true/false</b> из любого поля модели,
    либо сгенерировать (bool) значение на основе модели.
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\NoInputBoolean;

public function fields(): array
{
    return [
        NoInputBoolean::make('No input boolean', 'no_input_bool', static fn() => fake()->boolean())
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/no-input-boolean.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/no-input-boolean_dark.png') }}"></x-image>

</x-page>
