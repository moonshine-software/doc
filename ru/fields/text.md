# Text (Editing...)

- [Введение](#introduction)
- [Основные методы](#basic-methods)
  - [make](#make)
  - [placeholder](#placeholder)
  - [mask](#mask)
  - [tags](#tags)
- [Модификаторы](#modifiers)
  - [updateOnPreview](#update-on-preview)
  - [withUpdateRow](#with-update-row)
  - [updateInPopover](#update-in-popover)
- [Атрибуты](#attributes)
  - [readonly](#readonly)
  - [disabled](#disabled)
  - [required](#required)
- [Валидация](#validation)
  - [customAttributes](#custom-attributes)
- [Расширения ввода](#input-extensions)
  - [copy](#copy)
  - [eye](#eye)
  - [locked](#locked)
  - [suffix](#suffix)
- [Форматирование](#formatting)
  - [unescape](#unescape)
- [Значение по умолчанию](#default-value)
  - [default](#default)

## Введение
Поле `Text` - это базовое текстовое поле ввода в MoonShine. Это поле эквивалент `<input type="text">`

## Основные методы

### make
Метод `make()` используется для создания экземпляра поля `Text`.

```php
make(string $label, ?string $column = null)
```

Пример использования:

```php
use MoonShine\UI\Fields\Text;

Text::make('Name')
```

### placeholder
Метод `placeholder()` позволяет задать текст-подсказку для поля.

```php
placeholder(string $value)
```

Пример использования:

```php
Text::make('Имя пользователя', 'username')
    ->placeholder('Введите имя пользователя')
```

### mask
Метод `mask()` позволяет применить маску к вводимому тексту.

```php
mask(string $mask)
```

Пример использования:

```php
Text::make('Телефон', 'phone')
    ->mask('+7 (999) 999-99-99')
```

### tags

Метод `tags()` преобразует текстовое поле в поле для ввода тегов.

```php
tags(?int $limit = null)
```

Пример использования:

```php
Text::make('Теги', 'tags')
    ->tags(5)
```

## Модификаторы

### updateOnPreview

Метод `updateOnPreview()` позволяет обновлять значение поля в режиме предпросмотра.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null, array $events = [])
```

Пример использования:

```php
Text::make('Название', 'title')
    ->updateOnPreview()
```

### withUpdateRow

Метод `withUpdateRow()` позволяет обновлять строку таблицы при изменении значения поля.

```php
withUpdateRow(string $component)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->withUpdateRow('items-table')
```

### updateInPopover

Метод `updateInPopover()` позволяет обновлять значение поля в всплывающем окне.

```php
updateInPopover(string $component)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->updateInPopover('items-popover')
```

## Атрибуты

### readonly

Метод `readonly()` делает поле доступным только для чтения.

```php
readonly(Closure|bool|null $condition = null)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->readonly()
```

### disabled

Метод `disabled()` отключает поле.

```php
disabled(Closure|bool|null $condition = null)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->disabled()
```

### required

Метод `required()` делает поле обязательным для заполнения.

```php
required(Closure|bool|null $condition = null)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->required()
```

## Валидация

### customAttributes

Метод `customAttributes()` позволяет добавить пользовательские атрибуты к полю.

```php
customAttributes(array $attributes)
```

Пример использования:

```php
Text::make('Название', 'title')
    ->customAttributes(['data-custom' => 'value'])
```

## Расширения ввода

### copy

Метод `copy()` добавляет кнопку для копирования значения поля.

```php
copy(string $value = '{{value}}')
```

Пример использования:

```php
Text::make('Токен', 'token')
    ->copy()
```

### eye

Метод `eye()` добавляет кнопку для показа/скрытия значения поля (например, для пароля).

```php
eye()
```

Пример использования:

```php
Text::make('Пароль', 'password')
    ->eye()
```

### locked

Метод `locked()` добавляет иконку замка к полю.

```php
locked()
```

Пример использования:

```php
Text::make('Защищенное поле', 'protected_field')
    ->locked()
```

### suffix

Метод `suffix()` добавляет суффикс к полю ввода.

```php
suffix(string $ext)
```

Пример использования:

```php
Text::make('Домен', 'domain')
    ->suffix('.com')
```

## Форматирование

### unescape

Метод `unescape()` отключает экранирование HTML-тегов в значении поля.

```php
unescape()
```

Пример использования:

```php
Text::make('HTML-контент', 'content')
    ->unescape()
```

## Значение по умолчанию

### default

Метод `default()` устанавливает значение по умолчанию для поля.

```php
default(mixed $default)
```

Пример использования:

```php
Text::make('Статус', 'status')
    ->default('Активный')
```

