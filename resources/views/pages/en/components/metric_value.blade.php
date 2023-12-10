<x-page
    title="Metrics Value"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#progress', 'label' => 'Progress'],
            ['url' => '#value-format', 'label' => 'Value Format'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#column-span', 'label' => 'Block width'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>ValueMetric</em> metric is designed to display a value.
    For example, how many records are in the table.
</x-p>

<x-p>
    You can create a <em>ValueMetric</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    The <code>value()</code> method allows you to specify a value for a metric.
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

<x-sub-title id="progress">Progress</x-sub-title>

<x-p>
    The <code>progress()</code> method allows you to display a progress indicator for achieving a goal in a metric.
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
    When using a progress bar, the <code>value()</code> method must be passed a numeric value
    or a closure that will return a number.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/value_metric_progress.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/value_metric_progress_dark.png') }}"></x-image>

<x-sub-title id="value-format">Value Format</x-sub-title>

<x-p>
    The <code>valueFormat()</code> method allows you to format the metric value and add a prefix and suffix.
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

<x-sub-title id="column-span">Block width</x-sub-title>

@include('pages.ru.components.shared.metric_column_span', ['metric' => 'ValueMetric'])

</x-page>
