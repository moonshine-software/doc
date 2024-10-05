# Textarea

## Основы

Содержит все [Базовые методы](#/docs/{{version}}/fields/basic-methods.md).

Поле `Textarea` - это многострочное текстовое поле ввода в MoonShine. Это поле эквивалент тегу `<textarea></textarea>`

```php
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
```

## Высота поля

Чтобы задать высоту поля - можно воспользоваться методом [custom-attributes](#/docs/{{version}}/fields/basic-methods.md#custom-attributes).

```php
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
    ->customAttributes([
        'rows' => 6,
    ])
```


