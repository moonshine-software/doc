# Метрики

На странице индекса вы можете отображать информационные блоки со статистикой - метрики.
Для этого в методе `metrics()` страницы `IndexPage` верните массив из `Metric`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

class PostIndexPage extends IndexPage
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

Если вам необходимо обернуть метрики во `Fragment`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Crud\Components\Fragment;

protected function fragmentMetrics(): ?Closure
{
    return static fn(array $components): Fragment => Fragment::make($components)->name('metrics');
}
```

> [!TIP]
> Если вы хотите, чтобы метрики обновлялись автоматически, используйте метод `autoUpdate()`.
> Подробнее в разделе [Fragment](/docs/{{version}}/components/fragment#auto-update).
