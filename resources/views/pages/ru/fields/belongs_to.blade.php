<x-page title="BelongsTo">

<x-p>Поле для отношений в laravel типа belongsTo</x-p>

<x-p>Отображается как select, также есть возможность добавить поиск по значениям с помощью метода:
<code>searchable</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        // с указанием отношения
        BelongsTo::make('Страна', 'country', 'name')
        // или можно поле
        BelongsTo::make('Страна', 'country_id', 'name')
    ];
}
//...
</x-code>

<x-p>Третий аргумент со значением "name" является полем в связанной таблице countries для отображения значений</x-p>

<x-p>Также третьим параметром можно передать ресурс у которого указано поле для отображения</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Страна', 'country', new CountryResource())
            ->searchable()
    ];
}
//...
</x-code>

<x-code language="php">
namespace App\MoonShine\Resources;

use Leeto\MoonShine\Resources\Resource;
use App\Models\Country;

class CountryResource extends Resource
{
//...

public string $titleField = 'name'; // [tl! focus]

//...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-p>Если необходимо более сложное значение для отображения, то в третий аргумент можно передать функцию</x-p>
<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Страна', 'country', fn($item) => "$item->id.) $item->name")
    ];
}
//...
</x-code>

<x-p>Если необходимо по умолчанию значение Null</x-p>
<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Страна', 'country')
            ->nullable()
    ];
}
//...
</x-code>

<x-p>Не забудьте, также на уровне таблицы в базе данных указать, что поле может быть Null</x-p>

</x-page>
