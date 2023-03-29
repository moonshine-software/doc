<x-page title="Basics">

<x-p>
    Filters are displayed on the main page of the resource to filter data
</x-p>

<x-p>
    Filters work in exactly the same way as fields, except that they are declared in
     <code>filters</code> resource method
</x-p>

<x-code language="php">
//...

public function filters(): array
{
    return [
        TextFilter::make('Name', 'name')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

</x-page>
