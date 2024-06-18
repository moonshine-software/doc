<x-sub-title id="only-link">Link only</x-sub-title>

<x-p>
    The <code>onlyLink()</code> method will allow you to display the relationship as a link with the number of elements.
</x-p>

<x-code language="php">
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
</x-code>

<x-p>
    You can pass optional parameters to the method:
    <x-ul>
        <li><code>linkRelation</code> - link to the relationship;</li>
        <li>
            <code>condition</code> - closure or boolean value,
            responsible for displaying the relationship as a link.
        </li>
    </x-ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink() // [tl! focus]
    ];
}

//...
</x-code>

@if ($field === 'HasMany')
<x-image theme="light" src="{{ asset('screenshots/has_many_link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_link_dark.png') }}"></x-image>
@endif

<x-moonshine::divider label="linkRelation"></x-moonshine::divider>

<x-p>
    The <code>linkRelation</code> parameter allows you to create a link to a relation with a parent resource binding.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink('{{ str($label)->singular()->studly()->lower() }}') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="condition"></x-moonshine::divider>

<x-p>
    The <code>condition</code> parameter via a closure will allow you to change the display method depending on the conditions.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $label }}', resource: new {{ str($label)->singular()->studly() }}Resource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>
