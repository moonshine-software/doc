<x-page
    title="Дата"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#with-time', 'label' => 'Дата и время'],
            ['url' => '#format', 'label' => 'Формат'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Date</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=date</code> и имеет дополнительные методы.
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

<x-sub-title id="with-time">Дата и время</x-sub-title>

<x-p>
    Использование метода <code>withTime()</code> дает возможность вводить в поле дату и время.
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

<x-sub-title id="format">Формат</x-sub-title>

<x-p>
    Метод <code>format()</code> позволяет изменить формат отображения значения поля в preview.
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
