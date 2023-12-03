<x-page
    title="Метрика Value"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#progress', 'label' => 'Прогресс'],
            ['url' => '#value-format', 'label' => 'Формат значения'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#column-span', 'label' => 'Ширина блока'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Метрика <em>ValueMetric</em> предназначена для отображения какого-либо значения.
    Например, сколько всего записей в таблице.
</x-p>

<x-p>
    Создать <em>ValueMetric</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    Метод <code>value()</code> позволяет указать значение для метрики.
</x-p>

<x-code language="php">
value(int|string|float|Closure $value)
</x-code>

<x-code language="php">
use MoonShine\Metrics\ValueMetric; // [tl! focus]

//...

public function components(): array
{
    return [
        ValueMetric::make('Completed orders')
            ->value(Order::completed()->count()) // [tl! focus:-1]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/value_metric.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/value_metric_dark.png') }}"></x-image>

<x-sub-title id="progress">Прогресс</x-sub-title>

<x-p>
    Метод <code>progress()</code> позволяет отобразить индикатор прогресса достижения цели в метрике.
</x-p>

<x-code language="php">
progress(int|float|Closure $target)
</x-code>

<x-code language="php">
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Open tasks')
            ->value(Task::opened()->count())
            ->progress(Task::count()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    При использовании индикатора прогресса, методу <code>value()</code> необходимо передать числовое значение
    или замыкание, которое вернет число.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/value_metric_progress.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/value_metric_progress_dark.png') }}"></x-image>

<x-sub-title id="value-format">Формат значения</x-sub-title>

<x-p>
    Метод <code>valueFormat()</code> позволяет отформатировать значение метрики и добавить префикс и суффикс.
</x-p>

<x-code language="php">
valueFormat(string|Closure $value)
</x-code>

<x-code language="php">
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Profit')
            ->value(Order::completed()->sum('price'))
            ->valueFormat(fn($value) => \Illuminate\Support\Number::forHumans($value)) // [tl! focus:-1]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/value_metric_format.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/value_metric_format_dark.png') }}"></x-image>

<x-sub-title id="icon">Icon</x-sub-title>

@include('pages.ru.components.shared.metric_icon', ['metric' => 'ValueMetric'])

<x-sub-title id="column-span">Ширина блока</x-sub-title>

@include('pages.ru.components.shared.metric_column_span', ['metric' => 'ValueMetric'])

</x-page>
