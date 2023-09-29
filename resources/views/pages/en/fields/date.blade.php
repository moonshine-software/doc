<x-page title="Date">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Input has date type and additional method - <code>format</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\Date;

//...
public function fields(): array
{
    return [
        Date::make('Creation date', 'created_at')
            ->format('d.m.Y') // Date display format on the main resource
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/date.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/date_dark.png') }}"></x-image>

<x-p>
    Use the <code>withTime</code> method to display not only the date but also the time in the field
</x-p>

<x-code language="php">
use MoonShine\Fields\Date;

//...
public function fields(): array
{
    return [
        Date::make('Date and time of creation', 'created_at')
            ->withTime()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/date_time.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/date_time_dark.png') }}"></x-image>

</x-page>
