<x-page title="Основы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#filters', 'label' => 'Добавление фильтра'],
        ['url' => '#custom-query', 'label' => 'Кастомный запрос'],
    ]
]">

<x-sub-title id="filters">Добавление фильтра</x-sub-title>

<x-extendby :href="route('moonshine.page', 'fields-index')">
    Fields
</x-extendby>

<x-p>
    Фильтры отображаются на главной странице ресурса, для фильтрации данных.
    Они наследуются от соответствующих полей, поэтому им доступны все методы этих полей.
</x-p>

<x-p>
    Фильтры работают абсолютно так же как и поля, за тем исключением, что объявляется в
    методе ресурса <code>filters</code>
</x-p>

<x-code language="php">
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Filters\BelongsToManyFilter;
use MoonShine\Filters\DateRangeFilter;
use MoonShine\Filters\SlideFilter;
use MoonShine\Filters\SwitchBooleanFilter;
use MoonShine\Filters\TextFilter;

//...

public function filters(): array
{
    return [
        TextFilter::make('Title'),

        BelongsToFilter::make('Author', resource: 'name')
            ->nullable()
            ->canSee(fn() => auth('moonshine')->user()->moonshine_user_role_id === 1),

        TextFilter::make('Slug'),

        BelongsToManyFilter::make('Categories')
            ->select(),

        DateRangeFilter::make('Created at'),

        SlideFilter::make('Age')
            ->fromField('age_from')
            ->toField('age_to')
            ->min(0)
            ->max(60),

        SwitchBooleanFilter::make('Active')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

<x-sub-title id="custom-query">Кастомный запрос</x-sub-title>

<x-p>
    Используя метод <code>customQuery</code> можно создать кастомный запрос для фильтра
</x-p>

<x-code language="php">
use MoonShine\Filters\DateRangeFilter;
use MoonShine\Filters\TextFilter;

//...

public function filters(): array
{
    return [
        TextFilter::make('Title')
            ->customQuery(fn(Builder $query, $value) => $query->where('title', 'LIKE', "%${value}%")), // [tl! focus]

        DateRangeFilter::make('Created at')
            ->customQuery(function (Builder $query, $values) {
                return $query
                    ->when($values['from'] ?? null, function ($query, $fromDate) {
                        $query->whereDate('created_at', '>=', Carbon::parse($fromDate));
                    })
                    ->when($values['to'] ?? null, function ($query, $toDate) {
                        $query->whereDate('created_at', '<=', Carbon::parse($toDate));
                    });
            }), // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
