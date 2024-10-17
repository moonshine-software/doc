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
![metrics](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/metrics.png)
![metrics_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/metrics_dark.png)

> [!NOTE]
> For more detailed information, please refer to the sections [Donut Chart](https://moonshine-laravel.com/docs/resource/components/components-metric_donut_chart), [Line Chart](https://moonshine-laravel.com/docs/resource/components/components-metric_line_chart) and [Value](https://moonshine-laravel.com/docs/resource/components/components-metric_value).
