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
        Select::make('Статус активности', 'active')
            ->options([
                '0' => 'Только НЕ активные',
                '1' => 'Только активные',
            ])
            ->nullable()
            ->onApply(fn(Builder $query, $value) => $query->where('active', $value)), // [tl! focus:-6]
    ];
}

//...
}
</x-code>

</x-recipe>
