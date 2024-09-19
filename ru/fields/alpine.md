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

<a name="x-data-link"></a>
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

<a name="x-model-link"></a>
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

<a name="x-if-link"></a>
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

<a name="x-show-link"></a>
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

<a name="x-html-link"></a>
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