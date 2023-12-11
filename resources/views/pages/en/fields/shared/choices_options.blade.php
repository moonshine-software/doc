<x-sub-title id="options">Options</x-sub-title>

<x-p>
    All choices options are available to change via <em>data attributes</em>:
</x-p>

@if($field === 'BelongsTo')
<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->searchable()
            ->customAttributes([
                'data-search-result-limit' => 5
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>
@elseif($field === 'BelongsToMany')
<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', resource: new CountryResource())
            ->selectMode()
            ->customAttributes([
                'data-max-item-count' => 2
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>
@else
<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                1 => 'Andorra',
                2 => 'United Arab Emirates',
                //...
            ])
            ->multiple()
            ->customAttributes([
                'data-max-item-count' => 2
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>
@endif

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more details please contact
    <x-link link="https://choices-js.github.io/Choices/" target="_blank">Choices</x-link>.
</x-moonshine::alert>
