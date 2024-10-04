# Number

- [Основы](#basics)
- [Значение по умолчанию](#default)
- [Только для чтения](#readonly)
- [Placeholder](#placeholder)
- [Stars](#stars)
- [Кнопки +/-](#buttons)
- [Редактирование в preview](#update-on-preview)

---

<a name="basics"></a>

## Основы

```php
use MoonShine\UI\Fields\Number;

Number::make()
```

<a name="default"></a>

## Значение по умолчанию

Можно воспользоваться методом `default()`, если необходимо указать значение по умолчанию для поля.

```php
default(mixed $defaultValue)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Order')
    ->default(2) 
```

<a name="readonly"></a>

## Только для чтения

Если поле доступно только для чтения, то необходимо воспользоваться методом `readonly()`.

```php
readonly(Closure|bool|null $condition = null)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Order')
    ->readonly()
```

<a name="placeholder"></a>

## Placeholder

Метод `placeholder()` позволяет задать у поля атрибут _placeholder_.

```php
placeholder(string $value)
```

```php
Number::make('Order')
    ->placeholder('Item order') 
```

<a name="attributes"></a>

## Атрибуты

Поле _Number_ имеет дополнительные атрибуты, которые можно задать через соответствующие методы.

Методы `min()` и `max()` используются для задания минимального и максимального значения у поля.

> [!NOTE]
> [детальнее про min аттрибут](https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/min).

> [!NOTE]
> [детальнее про max аттрибут](https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/max).

```php
min(int|float $min)
```

```php
max(int|float $max)
```

Метод `step()` используются для задания шага значений у поля.

> [!NOTE]
> [детальнее про step аттрибут](https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/step).

```php
step(int|float $step)
```

Пробуем всё вместе:

```php
Number::make('Price')
    ->min(0)
    ->max(100000)
    ->step(0.01)
```

<a name="stars"></a>

## Stars

Метод `stars()` используется для отображения числового значения при preview в виде звезд (например для рейтинга).

```php
stars()
```

```php
Number::make('Rating')
    ->stars()
    ->min(1)
    ->max(10)
```

<a name="buttons"></a>

## Кнопки +/-

Метод `buttons()` позволяет добавить к полю кнопки для увеличения и уменьшения значения.

```php
buttons()
```

```php
Number::make()
    ->buttons()
```

![#number_fields_buttons](https://moonshine-laravel.com/screenshots/number_buttons.png)

<a name="update-on-preview"></a>

## Редактирование в preview

Метод `updateOnPreview()` позволяет редактировать поле Number в режиме preview.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null, array $events = [])
```

- $url - url для обработки асинхронного запроса,
- $resource - ресурс модели на которую ссылается отношение,
- $condition - условие выполнения метода,
- $events - JS события, которые будут выполнены после обновления.

```
> [!WARNING]
> Параметры не являются обязательными и их необходимо передавать, если поле работает вне ресурса.
```

```php
Number::make()
    ->updateOnPreview() 
```
