<x-page title="Textarea">

<x-p>
    Textarea поле включает в себя все базовые методы
</x-p>

<x-code language="php">
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Лейбл', 'table_field')
    ];
}

//...
</x-code>

</x-page>
