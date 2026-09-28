# Textarea

- [Основы](#basics)
- [Высота поля](#rows)
- [Отключение экранирования](#unescape)
- [Экранирование при применении](#escape-on-apply)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Textarea` - это многострочное текстовое поле ввода в **MoonShine**. Это поле эквивалент тегу `<textarea></textarea>`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
```

@preview('fields.textarea')

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

Поле наследует глобальные [настройки `escape` и `escape_on_apply`](/docs/{{version}}/configuration#field-escaping), обе по умолчанию равны `true`. Настройка `escape` управляет и preview, и значением внутри элемента формы textarea.
Явные вызовы `escape()` и `unescape()` переопределяют `escape`; они не меняют экранирование при применении переданных значений.

<a name="escape-on-apply"></a>
## Экранирование при применении

Как и у [Text](/docs/{{version}}/fields/text#escape-on-apply), метод `escapeOnApply()` переопределяет глобальную настройку независимо от экранирования при отображении:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Textarea;

Textarea::make('HTML Content', 'content')
    ->escape()
    ->escapeOnApply(fn (Textarea $field): bool => false)
```

Этот пример сохраняет исходную строку, экранируя её при отображении. Чтобы явно включить экранирование при применении, даже если оно отключено глобально, используйте `->escapeOnApply()` без аргумента. Метод поля принимает замыкание, а не boolean.
