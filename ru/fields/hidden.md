# Hidden

- [Основы](#basics)
- [Отображение значения](#show-value)

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](#/docs/{{version}}/fields/basic-methods.md).

Поле `Hidden` - это скрытое поле. Это поле эквивалент `type=hidden`.

> [!NOTE]
> Поле будет скрыто при построении форм, но отображается в preview, так же будет скрыт и его wrapper.

```php
use MoonShine\UI\Fields\Hidden;

Hidden::make('category_id')
```

<a name="show-value"></a>
## Отображение значения

Поле полностью скрыто в форме, но если требуется сохранить поведение поля, но при этом вывести его значение, то воспользуйтесь методом `showValue`:

```php
Hidden::make('category_id')->showValue()
```