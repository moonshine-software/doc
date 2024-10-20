# Date

- [Основы](#basics)
- [Основные методы](#basic-methods)
  - [Дата и время](#date-and-time)
  - [Формат](#format)
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

Поле *Date* является эквивалентом `<input type="date">`.

```php
use MoonShine\UI\Fields\Date;

Date::make('Created at', 'created_at')
```

![Creation date](https://moonshine-laravel.com/screenshots/date_dark.png)

![Creation date](https://moonshine-laravel.com/screenshots/date.png)

<a name="basic-methods"></a>
## Основные методы

<a name="date-and-time"></a>
### Дата и время

Использование метода `withTime()` позволяет вводить в поле дату и время.

```php
withTime()
```

```php
Date::make('Created at', 'created_at')
    ->withTime()
```

![date_time](https://moonshine-laravel.com/screenshots/date_time.png)

![date_time_dark](https://moonshine-laravel.com/screenshots/date_time_dark.png)

<a name="format"></a>
### Формат

Метод `format()` позволяет изменить формат отображения значения поля в preview.

```php
format(string $format)
```

```php
Date::make('Created at', 'created_at')
    ->format('d.m.Y')
```

<a name="extensions"></a>
## Расширения

Поля поддерживает различные расширения для помощи и контроля ввода

![expansion](https://moonshine-laravel.com/screenshots/expansion.png)

![expansion_dark](https://moonshine-laravel.com/screenshots/expansion_dark.png)

<a name="copy"></a>
### Копирование

Метод `copy()` добавляет кнопку для копирования значения поля.

```php
copy(string $value = '{{value}}')
```

Пример использования:

```php
Date::make('Created at', 'created_at')
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
Date::make('Created at', 'created_at')
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
Date::make('Created at', 'created_at')
    ->locked()
```

### Суффикс

Метод `suffix()` добавляет суффикс к полю ввода.

```php
suffix(string $ext)
```

<a name="preview-edit"></a>
### Редактирование в режиме preview

Данному полю доступно [редактирование в режиме preview](/docs/{{version}}/fields/basic-methods.md#preview-edit).

<a name="reactive"></a>
## Реактивность

Данному полю доступна [реактивность](/docs/{{version}}/fields/basic-methods.md#reactive).
