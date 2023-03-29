<x-page title="Value">

<x-p>
    Display a simple value, such as how many total records there are in a table
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
    It is also possible to display as a progress of the goal
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
The output value can be formatted and a prefix and suffix added
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
