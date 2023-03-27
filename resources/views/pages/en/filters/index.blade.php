<x-page title="Основы">

<x-p>
    Фильтры отображаются на главной странице ресурса, для фильтрации данных
</x-p>

<x-p>
    Фильтры работают абсолютно также как и поля, за тем исключением что объявляется в
    методе ресурса <code>filters</code>
</x-p>

<x-code language="php">
//...

public function filters(): array
{
    return [
        TextFilter::make('Имя', 'name')
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/filters.png') }}"></x-image>

</x-page>



