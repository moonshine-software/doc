<x-p>
    The <em>{{ $field }}</em> field is designed to work with the relation of the same name in Laravel
    and includes all the basic methods.
</x-p>

<x-p>
    To create this field, use the static <code>make()</code> method.
</x-p>

<x-code language="php">
{{ $field }}::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
</x-code>

<x-ul>
    <li></li><code>$label</code> - label, field header,</li>
    <li><code>$relationName</code> - name of the relationship,</li>
    @if($field !== 'HasOne' &&  $field !== 'HasMany')
    <li><code>$formatted</code> - a closure or field in a related table to display values,</li>
    @endif
    <li><code>$resource</code> - the model resource referenced by the relation.</li>
</x-ul>

@if($field === 'HasOne' || $field === 'HasMany')
<x-moonshine::alert type="error" icon="heroicons.information-circle">
    The <code>$formatted</code> parameter is not used in the <code>{{ $field }}</code> field!
</x-moonshine::alert>
@endif

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The presence of the model resource referenced by the relation is mandatory!<br />
    The resource also needs to be registered with the service provider <em>MoonShineApplicationServiceProvider</em> in the method
    <code>menu()</code> or <code>resources()</code>. Otherwise, there will be a 404 error.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->lower() }}', resource: new {{ str($label)->singular()->studly() }}Resource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/' . str($field)->snake('_')->append('.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($field)->snake('_')->append('_dark.png')) }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you do not specify <code>$relationName</code>,
    then the relation name will be determined automatically based on <code>$label</code>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    You can omit <code>$resource</code> if the model resource matches the name of the relationship.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }}; // [tl! focus]

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', '{{ str($label)->lower() }}') // [tl! focus]
    ];
}

//...
</x-code>

@if($field !== 'HasOne' && $field !== 'HasMany')

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    By default, a field in the related table is used to display the value.
    which is specified by the <code>$column</code> property in the model resource.<br />
    The <code>$formatted</code> argument allows you to override this.
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class {{ str($label)->singular()->studly() }}Resource extends ModelResource
{
    //...

    public string $column = 'title'; // [tl! focus]

    //...
}
</x-code>

<x-p>
    If you need to specify a more complex value to display,
    then the <code>$formatted</code> argument can be passed a callback function.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make(
            '{{ $label }}',
            '{{ str($label)->lower() }}',
            fn($item) => "$item->id. $item->title" // [tl! focus]
        )
    ];
}

//...
</x-code>

@endif
