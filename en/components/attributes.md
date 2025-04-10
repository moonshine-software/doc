# Component Attributes

- [Adding](#set-attribute)
- [Removing](#remove-attribute)
- [iterable Attributes](#iterable-attributes)
- [Massive Change](#custom-attributes)
- [Merging Values](#merge-attribute)
- [Adding/Removing Class](#class)
- [Adding Style](#style)
- [Attributes for Alpine.js](#alpine)
  - [x-data](#x-data)
  - [x-model](#x-model)
  - [x-if](#x-if)
  - [x-show](#x-show)
  - [x-html](#x-html)

___

Components offer a convenient mechanism for managing HTML classes, styles, and other attributes,
allowing for more flexibility in configuring their behavior and appearance.

<a name="set-attribute"></a>
## Adding

The method `setAttribute()` adds or alters a component's attribute.

```php
setAttribute(
    string $name,
    string|bool $value
)
```

- `$name` - the name of the attribute,
- `$value` - the value.

```php
$component->setAttribute('data-id', '123');
```

<a name="remove-attribute"></a>
## Removing

The method `removeAttribute()` removes an attribute by its name.

```php
removeAttribute(string $name)
```

- `$name` - the name of the attribute.

```php
$component->removeAttribute('data-id');
```

<a name="iterable-attributes"></a>
## Iterable Attributes

The method `iterableAttributes` adds attributes necessary for working with iterable components.

```php
iterableAttributes(int $level = 0)
```
- `$level` - the level of nesting.

<a name="custom-attributes"></a>
## Massive Change

The method `customAttributes()` adds or replaces multiple attributes of a component.

```php
customAttributes(
    array $attributes,
    bool $override = false
)
```

- `$attributes` - an array of attributes to be added,
- `$override` - a key that allows overwriting existing attributes.

```php
$component->customAttributes(['data-role' => 'admin'], true);
```

<a name="merge-attribute"></a>
## Merging Values

The method `mergeAttribute()` merges the value of an attribute with a new value, using the specified separator.

```php
mergeAttribute(
    string $name,
    string $value,
    string $separator = ' '
)
```

- `$name` - the name of the attribute,
- `$value` - the value,
- `$separator` - the separator.

```php
$component->mergeAttribute('class', 'new-class');
```

<a name="class"></a>
## Adding Class

The method `class()` adds CSS classes to the attributes of a component.

```php
class(string|array $classes)
```
- `$classes` - classes that need to be added to the component.

```php
$component->class(['btn', 'btn-primary']);
```

You can also remove a class or a set of classes previously added using a specific pattern.

```php
$component->removeClass('btn-success');
```

```php
$component->removeClass('btn-(success|primary)');
```

<a name="style"></a>
## Adding Style

The method `style` adds CSS styles to the attributes of a component.

```php
style(string|array $styles)
```

```php
$component->style(['color: red']);
```

<a name="alpine"></a>
## Attributes for Alpine.js

For convenient integration with the JavaScript framework **Alpine.js**, you can use methods for setting corresponding attributes.

<a name="x-data"></a>
### x-data

Everything in Alpine starts with the directive `x-data`.
The `xData()` method defines an HTML fragment as an **Alpine** component and provides reactive data to reference this component.

```php
xData(null|array|string $data = null)
```

```php
// title is a reactive variable inside
Div::make([])
    ->xData(['title' => 'Hello world'])
```

`x-data` specifying the component and its parameters:

```php
xDataMethod(
    string $method,
    ...$parameters
)
```

```php
Div::make([])
    ->xDataMethod('some-component', 'var', ['foo' => 'bar'])
```

<a name="x-model"></a>
### x-model

`x-model` binds a field to a reactive variable.

```php
xModel(?string $column = null)
```

```php
Div::make([
    Text::make('Title')->xModel()
])
    ->xData(['title' => 'Hello world'])
```

<a name="x-if"></a>
### x-if

`x-if` hides a field by removing it from the DOM.

```php
xIf(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

```php
Div::make([
    Select::make('Type')
        ->native()
        ->options([1 => 1, 2 => 2])
        ->xModel(),

    Text::make('Title')
        ->xModel()
        ->xIf('type', 1)
])
    ->xData(['title' = 'Hello world', 'type' => 1])

// or

Div::make([
    Select::make('Type')
        ->options([1 => 1, 2 => 2])
        ->xModel(),

    Text::make('Title')
        ->xModel()
        ->xIf(fn() => 'type==2||type.value==2')
])
    ->xData(['title' => 'Hello world', 'type' => 1])

// if you need to hide the field without a container

Div::make([
    Select::make('Type')
        ->native()
        ->options([1 => 1, 2 => 2])
        ->xModel(),

    Text::make('Title')
        ->xModel()
        ->xIf('type', '=', 2, wrapper: false)
])
    ->xData(['title' => 'Hello world', 'type' => 1])
```

<a name="x-show"></a>
### x-show

`x-show` is the same as `x-if`, but it does not remove the element from the DOM; it only hides it.

```php
xShow(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

<a name="x-html"></a>
### x-html

`x-html` outputs the value.

```php
xDisplay(
    string $value,
    bool $html = true
)
```

```php
Div::make([
    Select::make('Type')
        ->native()
        ->options([
            1 => 'Paid',
            2 => 'Free',
        ])
        ->xModel(),

    Number::make('Cost', 'price')
        ->xModel()
        ->xIf('type', '1'),

    Number::make('Rate', 'rate')
        ->xModel()
        ->xIf('type', '1')
        ->setValue(90),

    Div::make()
        ->xShow('type', '1')
        ->xDisplay('"Result:" + (price * rate)'),
])->xData([
    'price' => 0,
    'rate' => 90,
    'type' => '2',
]),
```
