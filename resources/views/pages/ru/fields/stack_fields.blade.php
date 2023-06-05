<x-page title="StackFields" :sectionMenu="[]">

<x-p>
    Поле <code>StackFields</code> позволяет группировать поля при отображении их на индексной странице.
</x-p>

<x-p>
    Методу <code>fields()</code> необходимо передать массив полей для группировки.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\StackFields; // [tl! focus]
use MoonShine\Fields\Text;
//...

public function fields(): array
{
    return [
        StackFields::make('Title')->fields([ // [tl! focus]
            Text::make('Title'),
            BelongsTo::make('Author', resource: 'name'),
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/stack_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/stack_fields_dark.png') }}"></x-image>

</x-page>
