# Textarea

- [Основы](#basics)
- [Высота поля](#rows)
- [Отключение экранирования](#unescape)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Textarea` - это многострочное текстовое поле ввода в **MoonShine**. Это поле эквивалент тегу `<textarea></textarea>`.

```php
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
```

<a name="rows"></a>
## Высота поля

Чтобы задать высоту поля - можно воспользоваться [атрибутами](/docs/{{version}}/fields/basic-methods#custom-attributes).

```php
Textarea::make('Text')
    ->customAttributes([
        'rows' => 6,
    ])
```

<a name="unescape"></a>
## Отключение экранирования

Метод `unescape()` отключает экранирование HTML-тегов в значении поля.

```php
Textarea::make('HTML-контент', 'content')
    ->unescape()
```
