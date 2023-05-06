<x-page title="Checkbox">

<x-p>
    The Checkbox field includes all the basic methods
</x-p>

<x-code language="php">
use MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make('Label', 'table_field')
    ];
}

//...
</x-code>

</x-page>



