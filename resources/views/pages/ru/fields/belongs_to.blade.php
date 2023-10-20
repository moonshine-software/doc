<x-page title="BelongsTo" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#default', 'label' => 'Значение по умолчанию'],
        ['url' => '#nullable', 'label' => 'Nullable'],
        ['url' => '#placeholder', 'label' => 'Placeholder'],
        ['url' => '#searchable', 'label' => 'Поиск значений'],
        ['url' => '#values-query', 'label' => 'Запрос для значений'],
		['url' => '#async-search', 'label' => 'Асинхронный поиск'],
		['url' => '#with-image', 'label' => 'Значения с изображением'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поле <em>BelongsTo</em> предназначено для работы с одноименными отношения в Laravel
    и включает в себя все базовые методы.
</x-p>

<x-p>
    Для создания данного поля используется так же статический метод <code>make()</code>.
</x-p>

<x-code language="php">
BelongsTo::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
</x-code>

<x-p>
    <code>$label</code> - лейбл, заголовок поля,<br>
    <code>$relationName</code> - название отношения,<br>
    <code>$formatted</code> - замыкание или поле в связанной таблице для отображения значений,<br>
    <code>$resource</code> - ресурс модели на которую ссылается отношение.
</x-p>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Наличие ресурса модели на которую ссылается отношение обязательно!
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если не указать <code>$relationName</code>,
    то название отношения будет определено автоматически на основе <code>$label</code>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Можно не указывать <code>$resource</code>, если ресурс модели соответствует названию отношения.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию для отображения значения используется поле в связанной таблице,
    которе задано свойством <code>$column</code> в ресурсе модели.<br />
    Аргумент <code>$formatted</code> позволяет это переопределить.
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CountryResource extends ModelResource
{
    //...

    public string $column = 'title'; // [tl! focus]

    //...
}
</x-code>

<x-p>
    Если необходимо задать более сложное значение для отображения,
    то аргументу <code>$formatted</code> можно передать callback функцию.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

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

<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Можно воспользоваться методом <code>default()</code>, если необходимо указать значение по умолчанию для поля.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-p>
    В качестве значения по умолчанию необходимо передать объект модели.
</x-p>

<x-code language="php">
use App\Models\Country;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->default(Country::find(1)) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    Как и у всех полей, если необходимо сохранять NULL, то нужно добавить метод <code>nullable()</code>
</x-p>

<x-code language="php">
nullable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Не забудьте в таблице базы данных указать, что поле может принимать значение <code>Null</code>.
</x-moonshine::alert>

<x-sub-title id="placeholder">Placeholder</x-sub-title>

<x-p>
    Метод <code>placeholder()</code> позволяет переопределить стандартный placeholder.
</x-p>

<x-code language="php">
placeholder(string $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->nullable()
            ->placeholder('Select country') // [tl! focus]
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

@include('pages.ru.fields.shared.values_query', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.async_search', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.with_image', ['field' => 'BelongsTo'])

</x-page>
