<x-page title="Значение">

<x-p>
    Отображение простого значения, например сколько всего в таблице определенных записей
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
    ValueMetric::make('Завершенных заказов')
        ->value(Orders::completed()->count())
    ];
} // [tl! focus:end]

//...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_dark.png') }}"></x-image>

<x-p>
    Также есть возможность отобразить в виде прогресса достижения цели
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

<x-p>
Выводимое значение можно отформатировать и добавить префикс и суффик
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
