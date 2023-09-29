<x-page title="IsEmptyFilter/IsNotEmptyFilter">

<x-extendby :href="route('moonshine.page', 'filters-switch')">
    SwitchBooleanFilter
</x-extendby>

<x-p>Позволяет отображать только строки, имеющие пустые (не пустые для IsNotEmptyFilter) значения поля</x-p>

<x-p>Пустыми значениями считаются:</x-p>
<x-ul :items="['NULL', '\'\'', 0]"></x-ul>

<x-code language="php">
use MoonShine\Filters\IsEmptyFilter;
use MoonShine\Filters\IsNotEmptyFilter;

//...

public function filters(): array
{
    return [
        IsEmptyFilter::make('Url'),
        IsNotEmptyFilter::make('Active')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_is_empty.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_is_empty_dark.png') }}"></x-image>

</x-page>
