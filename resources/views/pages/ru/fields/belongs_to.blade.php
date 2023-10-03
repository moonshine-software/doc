<x-page title="BelongsTo" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#searchable', 'label' => 'Поиск значений'],
		['url' => '#async-search', 'label' => 'Асинхронный поиск'],
        ['url' => '#values-query', 'label' => 'Запрос для значений'],
        ['url' => '#nullable', 'label' => 'Пустое значение'],
    ]
]">

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>Поле для отношений в Laravel типа <code>BelongsTo</code>. Отображается как поле select.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo; // [tl! focus]

//...
public function fields(): array
{
    return [
        // с указанием отношения
        BelongsTo::make('Country', 'country', 'name') // [tl! focus]
        // или можно поле
        BelongsTo::make('Country', 'country_id', 'name') // [tl! focus]
    ];
}
//...
</x-code>

<x-p>Третий аргумент со значением "name" является полем в связанной таблице countries для отображения значений.</x-p>

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-p>Также третьим параметром можно передать ресурс, у которого указано поле для отображения.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;  // [tl! focus]

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource()) // [tl! focus]
    ];
}
//...
</x-code>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\Resource;
use App\Models\Country;

class CountryResource extends Resource
{
    //...

    public string $titleField = 'name'; // [tl! focus]

    //...
}
</x-code>

<x-p>Если необходимо более сложное значение для отображения, то в третий аргумент можно передать функцию.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make(
            'Country',
            'country',
            fn($item) => "$item->id.) $item->name" // [tl! focus]
        )
    ];
}
//...
</x-code>

<x-sub-title id="searchable">Поиск значений</x-sub-title>

<x-p>
    Если необходим поиск среди значений, то нужно добавить метод <code>searchable()</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource())
            ->searchable() // [tl! focus]
    ];
}
//...
</x-code>

@include('pages.ru.fields.shared.async_search', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.values_query', ['field' => 'BelongsTo'])

<x-sub-title id="nullable">Пустое значение</x-sub-title>

<x-p>
    Если необходимо по умолчанию значение <code>Null</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
            ->nullable() // [tl! focus]
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Не забудьте также в таблице базы данных указать, что поле может быть <code>Null</code>.
</x-moonshine::alert>

</x-page>
