<x-page title="StackFields" :sectionMenu="[]">

<x-p>
    The <code>StackFields</code> field allows you to group fields when displayed in preview.
</x-p>

<x-p>
    The <code>fields()</code> method needs to be passed an array of fields to group.
</x-p>

<x-p>
    The <code>withLabels()</code> method can be used to display labels on the index page.
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
