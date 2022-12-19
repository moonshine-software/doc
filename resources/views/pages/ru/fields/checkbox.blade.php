<x-page title="Checkbox">

<x-p>
    Checkbox поле включает в себя все базовые методы
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make('Лейбл', 'table_field')
    ];
}

//...
</x-code>

</x-page>



