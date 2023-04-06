<x-page title="NoInput">

<x-p>
    <b>The field is not intended for data entry/modification!</b>
</x-p>

<x-p>
    With this field, you can output <b>true/false</b> value from any field in the model, or generate (bool) value based on the model.
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
