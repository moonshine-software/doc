<x-page title="Значение">

<x-p>
    Отображение простого значения, например сколько всего в таблице определенных записей
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;


use Leeto\MoonShine\Metrics\ValueMetric;

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

<x-p>
    Также есть возможность отобразить в виде прогресса достижения цели
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;


use Leeto\MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
//...

public function metrics(): array // [tl! focus:start]
{
    return [
        ValueMetric::make('Осталось открытых заказов')
            ->value(Orders::completed()->count())
            ->progress(200) // Конечная цель
    ];
} // [tl! focus:end]

//...
}
</x-code>

<x-image src="{{ asset('screenshots/metrics_value_progress.png') }}"></x-image>

<x-p>
Выводимое значение можно отформатировать и добавить префикс и суффик
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;


use Leeto\MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
//...

public function metrics(): array // [tl! focus:start]
{
    return [
        ValueMetric::make('Выручка')
            ->value(Orders::completed()->sum('price'))
            ->valueFormat('за сегодня {value} руб.')
    ];
} // [tl! focus:end]

//...
}
</x-code>

<x-image src="{{ asset('screenshots/metrics_value_format.png') }}"></x-image>
</x-page>
