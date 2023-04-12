<x-page title="Основы">

<x-extendby :href="route('moonshine.custom_page', 'fields-index')">
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

</x-page>
