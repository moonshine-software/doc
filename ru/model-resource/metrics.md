# Метрики

На странице индекса модели ресурса вы можете отображать информационные блоки со статистикой - метрики.
Для этого в методе `metrics()` верните массив из `Metric`.

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
> Для более подробной информации, обратитесь к разделам [Metrics](/docs/{{version}}/components/metrics).

Если вам необходимо обвернуть метрики во `Fragment`:

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
