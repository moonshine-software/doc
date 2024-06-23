<x-recipe id="custom-select-filter" title="{{ $title ?? 'Рецепт' }}">

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
//...

public function filters(): array
{
    return [
        Select::make('Активность', 'active')
            ->options([
                '0' => 'Only NOT active',
                '1' => 'Only active',
            ])
            ->nullable()
            ->onApply(fn(Builder $query, $value) => $query->where('active', $value)), // [tl! focus:-6]
    ];
}

//...
}
</x-code>

</x-recipe>
