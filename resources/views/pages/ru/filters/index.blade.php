<x-page title="Основы">

<x-p>
    Фильтры отображаются на главной странице ресурса, для фильтрации данных
</x-p>

<x-p>
    Фильтры работают абсолютно так же как и поля, за тем исключением, что объявляется в
    методе ресурса <code>filters</code>
</x-p>

<x-code language="php">
//...

public function filters(): array
{
    return [
        TextFilter::make('Title', title)
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

</x-page>
