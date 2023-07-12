<x-page title="Value">

<x-p>
    Displays a simple value, such as how many specific records a table contains
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
            ValueMetric::make('Completed orders')
                ->value(Orders::completed()->count())
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_dark.png') }}"></x-image>

<x-p>
    You can also display a value as a goal progress indicator
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
            ValueMetric::make('Open orders left')
                ->value(Orders::completed()->count())
                ->progress(200) // Ultimate goal
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_value_progress.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_value_progress_dark.png') }}"></x-image>

<x-p>
    You can add formatting, prefix, and suffix to the output value
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
            ValueMetric::make('Revenue')
                ->value(Orders::completed()->sum('price'))
                ->valueFormat('for today {value} rub.')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_value_format.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_value_format_dark.png') }}"></x-image>

</x-page>
