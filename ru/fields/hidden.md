# Hidden

- [Введение](#introduction)
- [Основные методы](#basic-methods)
    - [Отображение значения](#show-value)

<a name="introduction"></a>
## Введение
Поле `Hidden` - это скрытое поле. Это поле эквивалент `<input type="hidden">`

> [!NOTE]
> Поле будет скрыто при построении форм, но отображается в preview, так же будет скрыт и его wrapper.

```php
use MoonShine\UI\Fields\Hidden;

Hidden::make('category_id')
```

<a name="basic-methods"></a>
## Основные методы

<a name="show-value"></a>
### Отображение значения

Поле полностью скрыто в форме, но если требуется сохранить поведение поля, но при этом вывести его значение, то воспользуйтесь методом `showValue`:

```php
Hidden::make('category_id')->showValue()
```