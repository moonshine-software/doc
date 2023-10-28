<x-page
    title="Значение"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#progress', 'label' => 'Прогресс'],
            ['url' => '#format', 'label' => 'Формат'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Метрика <em>ValueMetric</em> предназначена для отображения какого-либо значения.
    Например, сколько всего в таблице записей.<br />
    Создать <em>ValueMetric</em> можно используя статический метод <code>make()</code>.
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
            ->value(Orders::completed()->count()) // [tl! focus:-1]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_dark.png') }}"></x-image>

<x-sub-title id="progress">Прогресс</x-sub-title>

<x-p>
    Также есть возможность отображения в виде прогресса достижения цели.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            ValueMetric::make('Open tasks')
                ->value(Task::opened()->count())
                ->progress(200) // Конечная цель
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_value_progress.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_value_progress_dark.png') }}"></x-image>

<x-sub-title id="format">Формат</x-sub-title>

<x-p>
Выводимое значение можно отформатировать и добавить префикс и суффикс.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            ValueMetric::make('Profit')
                ->value(Orders::completed()->sum('price'))
                ->valueFormat('Today ${value}')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_value_format.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_value_format_dark.png') }}"></x-image>

</x-page>
