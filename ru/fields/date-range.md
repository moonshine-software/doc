# DateRange

- [Основы](#basics)
- [Создание](#make)
- [Дата и время](#date-and-time)
- [Формат](#format)
- [Атрибуты](#attributes)
- [Фильтр](#filter)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

<a name="make"></a>
## Создание

Поле *DateRange* позволяет выбрать диапазон дат.
Так как диапазон дат имеет два значения, необходимо указать их с помощью метода `fromTo()`.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\UI\Fields\DateRange; 

DateRange::make('Даты')
    ->fromTo('date_from', 'date_to')
```

<a name="date-and-time"></a>
## Дата и время

Использование метода `withTime()` позволяет вводить в поля дату и время.

```php
withTime()
```

```php
DateRange::make('Даты')
    ->fromTo('date_from', 'date_to')
    ->withTime()
```

<a name="format"></a>
## Формат

Метод `format()` позволяет изменить формат отображения значений поля в preview.

```php
format(string $format)
```

```php
DateRange::make('Даты')
    ->fromTo('date_from', 'date_to')
    ->format('d.m.Y')
```

<a name="attributes"></a>
## Атрибуты

Поле *DateRange* имеет атрибуты, которые можно задать с помощью соответствующих методов.
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
DateRange::make('Даты')
    ->fromTo('date_from', 'date_to')
    ->min('2024-01-01')
    ->max('2024-12-31')
    ->step(5)
```

Если необходимо добавить пользовательские атрибуты для полей, можно использовать соответствующие методы `fromAttributes()` и `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
DateRange::make('Даты')
    ->fromTo('date_from', 'date_to')
    ->fromAttributes(['class'=> 'bg-black'])
    ->toAttributes(['class'=> 'bg-white'])
```

<a name="filter"></a>
## Фильтр

При использовании поля *DateRange* для построения фильтра метод `fromTo()` не используется, так как фильтрация происходит по одному полю в таблице базы данных.

```php
DateRange::make('Даты', 'dates')
```
