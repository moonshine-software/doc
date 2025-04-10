# ActionGroup

- [Основы](#basics)
- [Наполнение данными](#fill)
- [Добавление элементов](#add)

---

<a name="basics"></a>
## Основы

Компонент `ActionGroup` создан для быстрой группировки набора `ActionButton`, а также наполнения кнопок данными.

```php
ActionGroup::make(iterable $actions = [])
```

- `$actions` - набор `ActionButton`.

```php
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1'),
    ActionButton::make('Button 2'),
])
```

<a name="fill"></a>
## Наполнение данными

Чтобы наполнить все кнопки данными, воспользуйтесь методом `fill()` и передайте `DataWrapperContract`.

```php
ActionGroup::make($buttons)
    ->fill($data)
```

<a name="add"></a>
## Добавление элементов

Вы можете удобно манипулировать набором `ActionButton` с помощью методов `add()`, `prepend()` и `addMany()`.

```php
ActionGroup::make($buttons)
    ->add(ActionButton::make('Button 3'))
```

```php
ActionGroup::make($buttons)
    ->prepend(ActionButton::make('Button 4'))
```

```php
ActionGroup::make($buttons)
    ->addMany([
        ActionButton::make('Button 5'),
        ActionButton::make('Button 6'),
    ])
```
