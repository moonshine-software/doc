<x-page title="Range">

<x-p>
    Has the same methods as the "Number" field with additional methods <code>step</code>,
     <code>fromField</code>, <code>toField</code>
</x-p>

<x-p>
    Since the range has two values, it is necessary to specify these two fields in the database by methods
    <code>fromField</code> and <code>toField</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\SlideField;

//...
public function fields(): array
{
    return [
        SlideField::make('Age')
            ->fromField('age_from') // Field in the table for the value "From"
            ->toField('age_to') // Field in the table for the value "Before"
            ->min(0)
            ->max(60)
            ->step(1) // Slider pitch
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slide.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slide_dark.png') }}"></x-image>

</x-page>
