# Metrics

On the resource model index page, you can display informational blocks with statistics - metrics.
To do this, return an array of `Metric` in the `metrics()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Resources;

use App\Models\Post;
use App\Models\Comment;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use MoonShine\Laravel\Resources\ModelResource; // [tl! collapse:end]

class PostResource extends ModelResource
{
    // ...

    /**
     * @return list<Metric>
     */
    protected function metrics(): array
    {
        return [
            ValueMetric::make('Articles')
                ->value(fn() => Post::count())
                ->columnSpan(6),
            ValueMetric::make('Comments')
                ->value(fn() => Comment::count())
                ->columnSpan(6),
        ];
    }
}
```
![metrics](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/metrics.png#light)
![metrics_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/metrics_dark.png#dark)

> [!NOTE]
> For more detailed information, refer to the sections [Metrics](/docs/{{version}}/components/metrics).

If you need to wrap the metrics in a `Fragment`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Closure;
use MoonShine\Laravel\Components\Fragment;

protected function fragmentMetrics(): ?Closure
{
    return static fn(array $components): Fragment => Fragment::make($components)->name('metrics');
}
```
