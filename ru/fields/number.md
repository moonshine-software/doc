# Число

- [Создание](#make)
- [Значение по умолчанию](#default)
- [Только для чтения](#readonly)
- [Placeholder](#placeholder)
- [Атрибуты](#attributes)
- [Звезды](#stars)
- [Кнопки +/-](#buttons)
- [Редактирование в предпросмотре](#update-on-preview)

---

Расширяет [Text](/docs/{{version}}/fields/text)
* имеет те же функции

<a name="make"></a>
## Создание

Поле *Number* является расширением *Text*, которое по умолчанию устанавливает `type=number` и имеет дополнительные методы.

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Sort')
    ];
}

//...
```

<a name="default"></a>
## Значение по умолчанию

Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Title')
            ->default(2)
    ];
}

//...
```

<a name="readonly"></a>
## Только для чтения

Если поле предназначено только для чтения, то вы должны использовать метод `readonly()`.

```php
readonly(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Title')
            ->readonly()
    ];
}

//...
```

<a name="placeholder"></a>
## Placeholder

Метод `placeholder()` позволяет установить атрибут *placeholder* для поля.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating', 'rating')
            ->nullable()
            ->placeholder('Рейтинг продукта')
    ];
}

//...
```

<a name="attributes"></a>
## Атрибуты

Поле *Number* имеет дополнительные атрибуты, которые можно установить через соответствующие методы.

Методы `min()` и `max()` используются для установки минимального и максимального значений поля.

```php
min(int|float $min)
```

```php
max(int|float $max)
```

Метод `step()` используется для указания шага значения для поля.

```php
step(int|float $step)
```
```php
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Price')
            ->min(0)
            ->max(100000)
            ->step(5)
    ];
}

//...
```

<a name="stars"></a>
## Звезды

Метод `stars()` используется для отображения числового значения при предпросмотре в виде звезд (например, для рейтингов).

```php
stars()
```
```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->stars()
            ->min(1)
            ->max(10)
    ];
}

//...
```

<a name="buttons"></a>
## Кнопки +/-

Метод `buttons()` позволяет добавить к полю кнопки для увеличения или уменьшения значения.

```php
buttons()
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->buttons()
    ];
}

//...
```
![number_buttons](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/number_buttons.png)

<a name="update-on-preview"></a>
## Редактирование в предпросмотре

Метод `updateOnPreview()` позволяет редактировать поле *Number* в режиме *предпросмотра*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

- `$url` - URL для обработки асинхронного запроса,
- `$resource` - ресурс модели, на который ссылается отношение,
- `$condition` - условие выполнения метода.

> [!NOTE]
> Настройки не обязательны и должны быть переданы, если поле работает вне ресурса.

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make(Country)
            ->updateOnPreview()
    ];
}

//...
```
