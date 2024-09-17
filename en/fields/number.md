https://moonshine-laravel.com/docs/resource/fields/fields-number?change-moonshine-locale=en

------
#Number

-[Make](#make)
-[Default value](#default)
-[Only for reading](#readonly)
-[Placeholder](#placeholder)
-[Attributes](#attributes)
-[Stars](#stars)
-[+/-buttons](#buttons)
-[Editing in preview](#update-on-preview)

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* has the same features

<a name="make"></a>
## Make

The *Number* field is an extension of *Text*, which by default sets `type=number` and has additional methods.

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Sort')
    ];
}

//...
```

<a name="default"></a>
## Default value

You can use the `default()` method if you need to specify a default value for a field.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Title')
            ->default(2)
    ];
}

//...
```

<a name="readonly"></a>
## Only for reading

If the field is read-only, then you must use the `readonly()` method.

```php
readonly(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Title')
            ->readonly()
    ];
}

//...
```

<a name="placeholder"></a>
## Placeholder

The `placeholder()` method allows you to set *placeholder* attribute on the field.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating', 'rating')
            ->nullable()
            ->placeholder('Product rating')
    ];
}

//...
```

<a name="attributes"></a>
## Attributes

The *Number* field has additional attributes, which can be set through the appropriate methods.

Methods `min()` and `max()` are used to set the minimum and maximum values of a field.

```php
min(int|float $min)
```

```php
max(int|float $max)
```

The `step()` method is used to specify a step value for a field.

```php
step(int|float $step)
```
```php
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Price')
            ->min(0)
            ->max(100000)
            ->step(5)
    ];
}

//...
```

<a name="stars"></a>
## Stars

The `stars()` method is used to display a numeric value when previewing in the form of stars (for example, for ratings).

```php
stars()
```
```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->stars()
            ->min(1)
            ->max(10)
    ];
}

//...
```

<a name="buttons"></a>
## +/- buttons

The `buttons()` method allows you to add buttons to a field for increasing or decreasing a value.

```php
buttons()
```

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->buttons()
    ];
}

//...
```
![number_buttons](https://moonshine-laravel.com/screenshots/number_buttons.png)

<a name="update-on-preview"></a>
## Editing in preview

The `updateOnPreview()` method allows you to edit the *Number* field in *preview* mode.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

- `$url` - url for asynchronous request processing,
- `$resource` - model resource referenced by the relationship,
- `$condition` - method run condition.

> [!NOTE]
> The settings are not required and must be passed if the field is running out of resource.

```php
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make(Country)
            ->updateOnPreview()
    ];
}

//...
```
