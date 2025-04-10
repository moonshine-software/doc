# Collapse

- [Основы](#basics)
- [Иконка](#icon)
- [Отображение](#show)
- [Сохранение состояния](#persist)

---

<a name="basics"></a>
## Основы

`Collapse` позволяет сворачивать содержимое блока, внутри которого могут содержаться различные компоненты.
При сворачивании состояние компонентов остается неизменным.

```php
make(
    Closure|string $label = '',
    iterable $components = [],
    bool $open = false,
    bool $persist = true
)
```

- `$label` - заголовок `Collapse`,
- `$components` - набор компонентов внутри `Collapse`,
- `$open` - флаг определяет, свёрнут или развёрнут `Collapse` по умолчанию,
- `$persist` - сохранение состояния внутри `Collapse`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Collapse;

Collapse::make('Title/Slug', [
    Text::make('Title'),
    Text::make('Slug'),
])
```
tab: Blade
```blade
<x-moonshine::collapse
    :label="'Title/Slug'"
    :components='$components'
/>
```
~~~

<a name="icon"></a>
## Иконка

Метод `icon()` позволяет добавить иконку.

```php
icon(
    string $icon,
    bool $custom = false,
    ?string $path = null
)
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [icons](/docs/{{version}}/appearance/icons).

<a name="show"></a>
## Отображение

По умолчанию декоратор `Collapse` отображается в свернутом виде.
Метод `open()` позволяет переопределить это поведение.

```php
open(Closure|bool|null $condition = null)
```

<a name="persist"></a>
## Сохранение состояния

По умолчанию `Collapse` запоминает состояние, но бывают случаи, когда этого делать не стоит.
Метод `persist()` позволяет переопределить это поведение.

```php
persist(Closure|bool|null $condition = null)
```
