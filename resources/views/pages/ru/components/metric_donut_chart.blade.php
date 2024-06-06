<x-page
    title="Метрика DonutChart"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#colors', 'label' => 'Цвета'],
            ['url' => '#decimals', 'label' => 'Дробная часть'],
            ['url' => '#column-span', 'label' => 'Ширина блока'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Метрика <em>DonutChartMetric</em> предназначена для создания Donut графиков.
</x-p>

<x-p>
    Создать <em>DonutChartMetric</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    Метод <code>values()</code> позволяет указать значение для метрики.
</x-p>

<x-code language="php">
values(array|Closure $values)
</x-code>

<x-code language="php">
use MoonShine\Metrics\DonutChartMetric; // [tl! focus]

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers') // [tl! focus]
            ->values(['CutCode' => 10000, 'Apple' => 9999]) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::grid>
{!!
    \MoonShine\Metrics\DonutChartMetric::make('Subscribers')
        ->values(['CutCode' => 10000, 'Apple' => 9999])
        ->columnSpan(4)
!!}
</x-moonshine::grid>

<x-sub-title id="colors">Цвета</x-sub-title>

<x-p>
    Метод <code>colors()</code> позволяет указать цвета для метрики.
</x-p>

<x-code language="php">
colors(array|Closure $values)
</x-code>

<x-code language="php">
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
            ->colors(['#ffcc00', '#00bb00']) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::grid>
{!!
    \MoonShine\Metrics\DonutChartMetric::make('Subscribers')
        ->values(['CutCode' => 10000, 'Apple' => 9999])
        ->colors(['#ffcc00', '#00bb00'])
        ->columnSpan(4)
!!}
</x-moonshine::grid>

<x-sub-title id="decimals">Дробная часть</x-sub-title>

<x-p>
    Метод <code>decimals()</code> позволяет указать максимальное количество знаков после запятой для итогового значения.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию отображается до трех знаков после запятой.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000.12, 'Apple' => 9999.32])
            ->decimals(0) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="column-span">Ширина блока</x-sub-title>

@include('pages.ru.components.shared.metric_column_span', ['metric' => 'DonutChartMetric'])

</x-page>
