# Метрики

На странице индекса модели ресурса вы можете отображать информационные блоки со статистикой - метрики. Для этого в методе `metrics()` верните массив из `ValueMetric`.

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
> Для более подробной информации, пожалуйста, обратитесь к разделам [Круговая диаграмма](https://moonshine-laravel.com/docs/resource/components/components-metric_donut_chart), [Линейный график](https://moonshine-laravel.com/docs/resource/components/components-metric_line_chart) и [Значение](https://moonshine-laravel.com/docs/resource/components/components-metric_value).
