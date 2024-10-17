# Диапазон дат

- [Создание](#make)
- [Дата и время](#with-time)
- [Формат](#format)
- [Атрибуты](#attributes)
- [Фильтр](#filter)

---

<a name="make"></a>
## Создание

Поле _DateRange_ включает все базовые методы и позволяет выбрать диапазон дат.

Поскольку диапазон дат имеет два значения, необходимо указать их с помощью метода `fromTo()`.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
    ];
}

//...
```

![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date-range.png) ![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date-range_dark.png)

<a name="with-time"></a>
## Дата и время

Использование метода `withTime()` позволяет вводить дату и время в поля.

```php
withTime()
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->withTime()
    ];
}

//...
```

<a name="format"></a>
## Формат

Метод `format()` позволяет изменить формат отображения значений полей в предпросмотре.

```php
format(string $format)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->format('d.m.Y')
    ];
}

//...
```

<a name="attributes"></a>
## Атрибуты

У поля _DateRange_ есть атрибуты, которые можно установить с помощью соответствующих методов.

Методы `min()` и `max()` используются для установки минимального и максимального значений даты.

```php
min(string $min)
```

```php
max(string $max)
```

Метод `step()` используется для установки шага даты для поля.

```php
step(int|float|string $step)
```

```php
use MoonShine\Fields\DateRange;

//...
public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->min('2023-01-01')
            ->max('2023-12-31')
            ->step(5)
    ];
}

//...
```

Если вам нужно добавить пользовательские атрибуты для полей, вы можете использовать соответствующие методы `fromAttributes()` и `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->fromAttributes(['placeholder'=> 'from'])
            ->toAttributes(['placeholder'=> 'to'])
    ];
}

//...
```

<a name="filter"></a>
## Фильтр

При использовании поля _DateRange_ для построения фильтра метод `fromTo()` не используется, поскольку фильтрация происходит по одному полю в таблице базы данных.

```php
use MoonShine\Fields\DateRange;

//...

public function filters(): array
{
    return [
        DateRange::make('Dates',  'dates')
    ];
}

//...
```

