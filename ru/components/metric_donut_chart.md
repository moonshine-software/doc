# Метрика Donut Chart

  - [Создание](#make)
  - [Цвета](#colors)
  - [Десятичные знаки](#decimals)
  - [Ширина блока](#column-span)

---

<a name="make"></a>
## Создание

Метрика *DonutChartMetric* предназначена для создания круговых диаграмм (Donut charts).

Вы можете создать *DonutChartMetric*, используя статический метод `make()`.

```php
make(Closure|string $label)
```

Метод `values()` позволяет указать актуальность для метрики.

```php
values(array|Closure $values)
```

```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Подписчики')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
    ];
}

//...
```

<a name="colors"></a> 
## Цвета

Метод `colors()` позволяет указать цвета для метрики.

```php
colors(array|Closure $values)
```

```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Подписчики')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
            ->colors(['#ffcc00', '#00bb00'])
    ];
}

//...
```

<a name="decimals"></a> 
## Десятичные знаки

Метод `decimals()` позволяет указать максимальное количество десятичных знаков для общего значения.

> [!NOTE]  
> По умолчанию отображается до трех десятичных знаков.

```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Подписчики')
            ->values(['CutCode' => 10000.12, 'Apple' => 9999.32])
            ->decimals(0)
    ];
}

//...
```

<a name="column-span"></a> 
## Ширина блока

Метод `columnSpan()` позволяет установить ширину блока в сетке *Grid*.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - актуально для десктопной версии,
- `$adaptiveColumnSpan` - актуально для мобильной версии.

```php
use App\Models\Article;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            DonutChartMetric::make('Подписчики')
                ->values(['CutCode' => 10000, 'Apple' => 9999])
                ->columnSpan(6),
            DonutChartMetric::make('Задачи')
                ->values(['Новые' => 234, 'Выполненные' => 421])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]  
> Подробнее смотрите в разделе [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout).

