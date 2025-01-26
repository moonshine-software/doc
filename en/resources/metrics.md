# Metrics

On the resource model index page, you can display information blocks with statistics - metrics.To do this, in the `metrics()` method, return an array from `ValueMetric`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function metrics(): array
    {
        return [
            ValueMetric::make('Articles')
                ->value(Post::count()),
        ];
    }

    //...
}
```
![metrics](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/metrics.png#light)
![metrics_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/metrics_dark.png#dark)

> [!NOTE]
> For more detailed information, please refer to the sections [Donut Chart](/docs/{{version}}/components/metric_donut_chart), [Line Chart](/docs/{{version}}/components/metric_line_chart) and [Value](/docs/{{version}}/components/metric_value).
