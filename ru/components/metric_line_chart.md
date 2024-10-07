# Метрика Line Chart  

- [Создание](#make)  
- [Сортировка ключей](#sorting-keys)  
- [Ширина блока](#column-span)  

---

<a name="make"></a>  
## Создание  

Метрика *LineChartMetric* предназначена для отображения линейных графиков.

Вы можете создать *LineChartMetric*, используя статический метод `make()`.

```php
make(Closure|string $label)
```

Метод `line()` позволяет добавить линию значений в метрику.  
Вы можете добавить несколько линий в *ValueMetric*.

```php
line(
    array|Closure $line,
    string|array|Closure $color = '#7843E9'
)
```

- `$line` - значения для построения графика,  
- `$color` - цвет линии.  

```php
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        LineChartMetric::make('Заказы')
            ->line([
                'Прибыль' => Order::query()
                    ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('sum','date')
                    ->toArray()
            ])
            ->line([
                'Среднее' => Order::query()
                    ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('avg','date')
                    ->toArray()
            ], '#EC4176')
    ];
}

//...
```

Вы можете определить несколько линий через один метод `line`.

```php
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        LineChartMetric::make('Заказы')
            ->line([
                'Прибыль' => Order::query()
                    ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('sum','date')
                    ->toArray(),
                'Среднее' => Order::query()
                    ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('avg','date')
                    ->toArray()
            ],[
                'red', 'blue'
            ])
    ];
}

//...
```

<a name="keys-sort"></a>  
## Сортировка ключей  

По умолчанию график *LineChart* имеет отсортированные по возрастанию ключи.  
Эту функцию можно отключить с помощью метода `withoutSortKeys()`.

```php
LineChartMetric::make('Заказы')
    ->line([
        'Прибыль' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ])
    ->withoutSortKeys(),
```

<a name="column-span"></a>  
## Ширина блока  

Метод `columnSpan()` позволяет установить ширину блока в сетке `Grid`.

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
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            LineChartMetric::make('Статьи')
                ->line([
                    'Количество' => [
                        now()->subDays()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
                ->columnSpan(6),
            LineChartMetric::make('Комментарии')
                ->line([
                    'Количество' => [
                        now()->subDays()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> Подробнее смотрите в разделе [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout).

