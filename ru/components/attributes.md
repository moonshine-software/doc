# Атрибуты компонентов

- [Добавление](#set-attribute)
- [Удаление](#remove-attribute)
- [Итеративные атрибуты](#iterable-attributes)
- [Массовое изменение](#custom-attributes)
- [Объединение значений](#merge-attribute)
- [Добавление класса](#class)
- [Добавление стиля](#style)
- [Атрибуты для Alpine.js](#alpine)
  - [x-data](#x-data)
  - [x-model](#x-model)
  - [x-if](#x-if)
  - [x-show](#x-show)
  - [x-html](#x-html)

___

Компоненты предлагают удобный механизм для управления HTML-классами, стилями и другими атрибутами,
что позволяет более гибко настраивать их поведение и внешний вид.

<a name="set-attribute"></a>
## Добавление

Метод `setAttribute()` добавляет или изменить атрибут компонента.

```php
setAttribute(string $name, string|bool $value)
```

- `$name` - название атрибута,
- `$value` - значение.

```php
$component->setAttribute('data-id', '123');
```

<a name="remove-attribute"></a>
## Удаление

Метод `removeAttribute()` удаляет атрибут по его имени.

```php
removeAttribute(string $name)
```

- `$name` - название атрибута.

```php
$component->removeAttribute('data-id');
```

<a name="iterable-attributes"></a>
## Итеративные атрибуты

Метод `iterableAttributes` добавляет атрибуты, необходимые для работы с итеративными компонентами.

```php
iterableAttributes(int $level = 0)
```
- `$level` - уровень вложенности.

<a name="custom-attributes"></a>
## Массовое изменение

Метод `customAttributes()` добавляет или заменяет несколько атрибутов компонента.

```php
customAttributes(array $attributes, bool $override = false)
```

- `$attributes` - массив добавляемых атрибутов,
- `$override` - ключ который позволяет перезаписать существующие атрибуты.

```php
$component->customAttributes(['data-role' => 'admin'], true);
```

<a name="merge-attribute"></a>
## Объединение значений

Метод `mergeAttribute()` объединяет значение атрибута с новым значением, используя указанный разделитель.

```php
mergeAttribute(string $name, string $value, string $separator = ' ')
```

- `$name` - название атрибута,
- `$value` - значение,
- `$separator` - разделитель.

```php
$component->mergeAttribute('class', 'new-class');
```

<a name="class"></a>
## Добавление класса

Метод `class()` добавляет CSS-классы к атрибутам компонента.

```php
class(string|array $classes)
```
- `$classes` - классы которые необходимо добавить к компоненту.

```php
$component->class(['btn', 'btn-primary']);
```

<a name="style"></a>
## Добавление стиля

Метод `style` добавляет CSS-стили к атрибутам компонента.

```php
style(string|array $styles)
```

```php
$component->style(['color' => 'red']);
```

<a name="alpine"></a>
## Быстрые атрибуты для Alpine.js

Для удобной интеграции с JavaScript-фреймворком `Alpine.js` используются методы установки соответствующих атрибутов.

# Alpine.js (Editing...)
- [Описание](#description)
    - [x-data](#x-data-link)
    - [x-model](#x-model-link)
    - [x-if](#x-if-link)
    - [x-show](#x-show-link)
    - [x-html](#x-html-link)
---

<a name="description"></a>
## Описание

Методы позволяющие удобно взаимодействовать с Alpine.js

<a name="x-data"></a>
### x-data

```php
xData(null|array|string $data = null)
```

Все в Alpine начинается с директивы `x-data`. метод `xData` определяет фрагмент HTML как компонент Alpine и предоставляет реактивные данные для ссылки на этот компонент.

```php
Block::make([])->xData(['title' = 'Hello world']) // title реактивная переменная внутри
```

```php
xDataMethod(string $method, ...$parameters)
```

`x-data` с указанием компонента и его параметров

```php
Block::make([])->xDataMethod('some-component', 'var', ['foo' => 'bar'])
```

<a name="x-model"></a>
### x-model
`x-model` связывание поля с реактивной переменной
```php
xModel(?string $column = null)
```
```php
Block::make([
    Text::make('Title')->xModel()
])->xData(['title' = 'Hello world'])

// или

Block::make([
    Text::make('Name')->xModel('title')
])->xData(['title' = 'Hello world'])
```

<a name="x-if"></a>
### x-if
```php
xIf(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-if` скрывает поле, удаляя его из DOM

```php
Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', 1)
])->xData(['title' = 'Hello world', 'type' => 1])

// или

Block::make([
    Select::make('Type')->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf(fn() => 'type==2||type.value==2')
])->xData(['title' = 'Hello world', 'type' => 1])

// если нужно скрыть поле без контейнера

Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', '=', 2, wrapper: false)
])->xData(['title' = 'Hello world', 'type' => 1])
```

<a name="x-show"></a>
### x-show
```php
xShow(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-show` тоже самое что и x-if, но не удаляет элемент из DOM, а только скрывает

```php
xDisplay(string $value, bool $html = true)
```

<a name="x-html"></a>
### x-html

`x-html` вывод значения

```php
Block::make([
    Select::make('Type')
        ->native()
        ->options([
            1 => 'Платно',
            2 => 'Бесплатно',
        ])
        ->xModel(),

    Number::make('Стоимость', 'price')
        ->xModel()
        ->xIf('type', '1'),

    Number::make('Ставка', 'rate')
        ->xModel()
        ->xIf('type', '1')
        ->setValue(90),

    LineBreak::make(),

    Div::make()
        ->xShow('type', '1')
        ->xDisplay('"Result:" + (price * rate)')
    ,
])->xData([
    'price' => 0,
    'rate' => 90,
    'type' => '2',
]),
```
