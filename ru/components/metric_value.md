# Метрика Value

  - [Создание](#make)
  - [Прогресс](#progress)
  - [Формат значения](#value-format)
  - [Иконка](#icon)
  - [Ширина блока](#column-span)

---

<a name="make"></a>
## Создание
Метрика `ValueMetric` предназначена для отображения значения. Например, сколько записей в таблице.

Вы можете создать `ValueMetric`, используя статический метод `make()`.

```php
make(Closure|string $label)
```

Метод `value()` позволяет указать значение для метрики.

```php
value(int|string|float|Closure $value)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Выполненные заказы')
            ->value(Order::completed()->count())
    ];
}

//...
```

<a name="progress"></a>
## Прогресс

Метод `progress()` позволяет отобразить индикатор прогресса достижения цели в метрике.

```php
progress(int|float|Closure $target)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Открытые задачи')
            ->value(Task::opened()->count())
            ->progress(Task::count())
    ];
}

//...
```

> [!NOTE]
> При использовании прогресс-бара в метод `value()` необходимо передавать числовое значение или замыкание, которое вернет число.

<a name="value-format"></a>
## Формат значения

Метод `valueFormat()` позволяет отформатировать значение метрики и добавить префикс и суффикс.

```php
valueFormat(string|Closure $value)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Прибыль')
            ->value(Order::completed()->sum('price'))
            ->valueFormat(fn($value) => \Illuminate\Support\Number::forHumans($value))
    ];
}

//...
```

<a name="icon"></a>
## Иконка

Метод `icon()` позволяет добавить иконку к метрике.

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Заказы')
            ->value(Order::count())
            ->icon('heroicons.shopping-bag')
    ];
}

//...
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

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
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            ValueMetric::make('Статьи')
                ->value(Article::count())
                ->columnSpan(6),
            ValueMetric::make('Комментарии')
                ->value(Comment::count())
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> Подробнее смотрите в разделе [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout).

