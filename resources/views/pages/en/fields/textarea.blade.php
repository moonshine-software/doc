<x-page title="Textarea">

<x-p>
    Textarea The field includes all the basic methods
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Label', 'table_field')
    ];
}

//...
</x-code>

</x-page>



