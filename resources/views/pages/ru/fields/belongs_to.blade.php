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

@include('pages.ru.fields.shared.relation_make', ['field' => 'BelongsTo', 'label' => 'Country'])


<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    При использовании поля <em>BelongsTo</em> для сортировки или фильтрации позиций необходимо через метод
    <code>setColumn()</code> задать поле в таблице базы данных, или переопределить метод
    <x-link :link="route('moonshine.page', 'resources-query') . '#order'" >
        сортировки
    </x-link> у ресурса модели.
</x-moonshine::alert>

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

@include('pages.ru.fields.shared.placeholder', ['field' => 'BelongsTo'])

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
