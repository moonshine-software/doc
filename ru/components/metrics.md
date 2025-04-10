# Метрики

- [Значение](#value)
- [Line/Donut](#line-donut)

---

<a name="value"></a>
## Значение

Метрика `ValueMetric` предназначена для отображения значения. Например, сколько записей в таблице.

```php
make(Closure|string $label)
```

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

ValueMetric::make('Completed orders')
    ->value(fn() => Order::completed()->count())
```
tab: Blade
```blade
<x-moonshine::metrics.value
    title="Completed orders"
    icon="shopping-bag"
    :value="$count"
    :progress="false"
/>
```
~~~

Метод `value()` позволяет указать значение для метрики.

```php
value(int|string|float|Closure $value)
```

```php
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

// ...

protected function components(): iterable
{
    return [
        ValueMetric::make('Completed orders')
            ->value(fn(): int => Order::completed()->count())
    ];
}
```

<a name="progress"></a>
### Прогресс

Метод `progress()` позволяет отобразить индикатор прогресса достижения цели в метрике.

```php
progress(int|float|Closure $target)
```

```php
ValueMetric::make('Open tasks')
    ->value(fn(): int => Task::opened()->count())
    ->progress(fn(): int => Task::count())
```

> [!NOTE]
> При использовании прогресс-бара в метод `value()` необходимо передавать числовое значение или замыкание, которое вернет число.

<a name="value-format"></a>
### Формат значения

Метод `valueFormat()` позволяет отформатировать значение метрики и добавить префикс и суффикс.

```php
valueFormat(string|Closure $value)
```

```php
ValueMetric::make('Profit')
    ->value(fn(): int => Order::completed()->sum('price'))
    ->valueFormat(fn(int $value): string => \Illuminate\Support\Number::forHumans($value))
```

<a name="icon"></a>
### Иконка

Метод `icon()` позволяет добавить иконку к метрике.

```php
ValueMetric::make('Orders')
    ->value(fn(): int => Order::count())
    ->icon('shopping-bag')
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](/docs/{{version}}/appearance/icons).

<a name="column-span"></a>
### Ширина блока

Метод `columnSpan()` позволяет установить ширину блока в сетке *Grid*.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - актуально для десктопной версии,
- `$adaptiveColumnSpan` - актуально для мобильной версии.

<a name="line-donut"></a>
## Line/Donut

Пакет устанавливается отдельно, основан на библиотеке [ApexCharts library](https://apexcharts.com/).

```shell
composer require moonshine/apexcharts
```

Подробнее в официальном репозитории [ApexCharts](https://github.com/moonshine-software/apexcharts).
