<x-page
    title="Date"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#with-time', 'label' => 'Date and time'],
            ['url' => '#format', 'label' => 'Format'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Date</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=date</code> and has additional methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Date; // [tl! focus]

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/date.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/date_dark.png') }}"></x-image>

<x-sub-title id="with-time">Date and time</x-sub-title>

<x-p>
    Using the <code>withTime()</code> method allows you to enter a date and time into a field.
</x-p>

<x-code language="php">
withTime()
</x-code>

<x-code language="php">
use MoonShine\Fields\Date;

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at')
            ->withTime() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/date_time.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/date_time_dark.png') }}"></x-image>

<x-sub-title id="format">Format</x-sub-title>

<x-p>
    The <code>format()</code> method allows you to change the display format of the field value in preview.
</x-p>

<x-code language="php">
format(string $format)
</x-code>

<x-code language="php">
use MoonShine\Fields\Date;

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at')
            ->format('d.m.Y') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
