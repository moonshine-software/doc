<x-page title="NoInput">

<x-p>
    <b>The field is not intended for data entry/modification!</b>
</x-p>

<x-p>
    With this field, you can output text data from any field in the model, or generate text based on the model.
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
