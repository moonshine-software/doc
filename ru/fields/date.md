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

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Date` является эквивалентом `<input type="date">`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Date;

Date::make('Created at', 'created_at')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Created at">
    <x-moonshine::form.input
        type="date"
        name="created_at"
    />
</x-moonshine::form.wrapper>

```
~~~

![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date.png#light)
![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_dark.png#dark)

<a name="basic-methods"></a>
## Основные методы

<a name="date-and-time"></a>
### Дата и время

Использование метода `withTime()` позволяет вводить в поле дату и время.

```php
Date::make('Created at', 'created_at')
    ->withTime()
```

![date_time](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_time.png#light)
![date_time_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_time_dark.png#dark)

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

Поля поддерживает различные расширения для помощи и контроля ввода.

![expansion](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion.png#light)
![expansion_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion_dark.png#dark)

<a name="copy"></a>
### Копирование

Метод `copy()` добавляет кнопку для копирования значения поля.

```php
copy(string $value = '{{value}}')
```

```php
Date::make('Created at', 'created_at')
    ->copy()
```

<a name="eye"></a>
### Скрытие значения

Метод `eye()` добавляет кнопку для показа/скрытия значения поля (например, для пароля).

```php
Date::make('Created at', 'created_at')
    ->eye()
```

<a name="locked"></a>
### Замок

Метод `locked()` добавляет иконку замка к полю.

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

Данному полю доступно [редактирование в режиме preview](/docs/{{version}}/fields/basic-methods#preview-edit).
