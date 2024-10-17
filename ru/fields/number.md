# Number

- [Основы](#basics)
- [Основные методы](#basic-methods)
  - [Значение по умолчанию](#default)
  - [Подсказка](#placeholder)
  - [Кнопки +/-](#buttons)
- [Методы для работы с числовыми значениями](#number-type-methods)
  - [Максимальное и минимальное значение](#min-and-max)
  - [Шаг](#step)
  - [Звезды](#stars)
- [Расширения](#extensions)
  - [Копирование](#copy)
  - [Скрытие значения](#eye)
  - [Замок](#locked)
  - [Суффикс](#suffix)
- [Редактирование в режиме preview](#preview-edit)
- [Реактивность](#reactive)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](#/docs/{{version}}/fields/basic-methods.md).

Поле `Number` - это базовое числовое поле ввода в MoonShine. Это поле эквивалент `<input type="number">`

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Number;

Number::make('Sort')
```
tab: Blade
```blade
<x-moonshine::field-container label="Sort">
    <x-moonshine::form.input
        type="number"
        name="sort"
    />
</x-moonshine::field-container>
```
~~~

<a name="basic-methods"></a>
## Основные методы

<a name="default"></a>
### Значение по умолчанию

Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Title')
    ->default(2)
```

<a name="placeholder"></a>
### Подсказка

Метод `placeholder()` позволяет установить атрибут *placeholder* для поля.

```php
placeholder(string $value)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating', 'rating')
    ->nullable()
    ->placeholder('Рейтинг продукта')
```

<a name="buttons"></a>
### Кнопки +/-

Метод `buttons()` позволяет добавить к полю кнопки для увеличения или уменьшения значения.

```php
buttons()
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating')
    ->buttons()
```

![number_buttons](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/number_buttons.png)

<a name="number-type-methods"></a>
## Методы для работы с числовыми значениями

<a name="min-and-max"></a>
### Максимальное и минимальное значение

Методы `min()` и `max()` используются для установки минимального и максимального значений поля.

```php
min(int|float $min)
```

```php
max(int|float $max)
```

<a name="step"></a>
### Шаг

Метод `step()` используется для указания шага значения для поля.

```php
step(int|float $step)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Price')
    ->min(0)
    ->max(100000)
    ->step(5)
```

<a name="stars"></a>
### Звезды

Метод `stars()` используется для отображения числового значения в режиме preview в виде звезд (например, для рейтингов).

```php
stars()
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating')
    ->stars()
    ->min(1)
    ->max(10)
```

<a name="extensions"></a>
## Расширения

Поля поддерживает различные расширения для помощи и контроля ввода

![expansion](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion.png)

![expansion_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion_dark.png)

<a name="copy"></a>
### Копирование

Метод `copy()` добавляет кнопку для копирования значения поля.

```php
copy(string $value = '{{value}}')
```

Пример использования:

```php
Number::make('Price')
    ->copy()
```

<a name="eye"></a>
### Скрытие значения

Метод `eye()` добавляет кнопку для показа/скрытия значения поля (например, для пароля).

```php
eye()
```

Пример использования:

```php
Number::make('Пароль', 'password')
    ->eye()
```

<a name="locked"></a>
### Замок

Метод `locked()` добавляет иконку замка к полю.

```php
locked()
```

Пример использования:

```php
Number::make('Защищенное поле', 'protected_field')
    ->locked()
```

### Суффикс

Метод `suffix()` добавляет суффикс к полю ввода.

```php
suffix(string $ext)
```

<a name="preview-edit"></a>
## Редактирование в режиме preview

Данному полю доступно [редактирование в режиме preview](/docs/{{version}}/fields/basic-methods.md#preview-edit).

<a name="reactive"></a>
## Реактивность

Данному полю доступна [реактивность](/docs/{{version}}/fields/basic-methods.md#reactive).