# Select

  - [Make](#make)
  - [Default value](#default)
  - [Nullable](#nullable)
  - [Placeholder](#placeholder)
  - [Groups](#groups)
  - [Selecting Multiple Values](#multiple)
  - [Search](#search)
  - [Asynchronous search](#async)
  - [Editing in preview](#update-on-preview)
  - [Values with picture](#with-image)
  - [Options](#options)
  - [Native mode](#native)

---

<a name="make"></a>
## Make

The _Select_ field includes all the basic methods.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
    ];
}

//...
```
![select](https://moonshine-laravel.com/screenshots/select_dark.png)

<a name="default"></a>
## Default value

You can use the `default()` method if you need to specify a default value for a field.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->default('value 2')
    ];
}

//...
```
<a name="nullable"></a>  
## Nullable

Like all fields, if you need to store NULL, you need to add the `nullable()` method

```php
nullable(Closure|bool|null $condition = null)
```
```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->nullable()
    ];
}

//...
```
![select nullabledark](https://moonshine-laravel.com/screenshots/select_nullable_dark.png)

<a name="placeholder"></a>
## Placeholder
The ```placeholder()``` method allows you to set *placeholder* attribute on the field.

```php
placeholder(string $value)
```
```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="groups"></a>
## Groups
You can combine values into groups.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('City', 'city_id')
            ->options([
                'Italy' => [
                    1 => 'Rome',
                    2 => 'Milan'
                ],
                'France' => [
                    3 => 'Paris',
                    4 => 'Marseille'
                ]
            ])
    ];
}

//...
```
![select group dark](https://moonshine-laravel.com/screenshots/select_group_dark.png)

<a name="multiple"></a>
## Selecting Multiple Values
To select multiple values, you need the `multiple()` method

```php
multiple(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->multiple()
    ];
}

//...
```
> [!TIP]
> When using `multiple()` for the Eloquent model, a field in the database type text or json is required.
You also need to add *cast* - json or array or collection.

![select multiple dark.](https://moonshine-laravel.com/screenshots/select_multiple_dark.png)

<a name="search"></a>
## Search
If you need to add a search among values, then you need to add the `searchable()` method.

```php
searchable()
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable()
    ];
}

//...
```
![searchable](https://moonshine-laravel.com/screenshots/select_searchable_dark.png)

<a name="async"></a>
## Asynchronous search
You can also organize an asynchronous search for the *Select* field. To do this, you need to pass *url* to the `async()` method, to which a request with a *query* search parameter will be sent.

```php
async(?string $asyncUrl = null)
```

The returned response with search results must be in *json* format.

```php
[
    {
        "value": 1,
        "label": "Option 1"
    },
    {
        "value": 2,
        "label": "Option 2"
    }
]
```
```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable()
            ->async('/search')
    ];
}

//...
```

<a name="update-on-preview"></a>
## Editing in preview
The `updateOnPreview()` method allows you to edit the *Select* field in *preview* mode.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

-`$url` - url for asynchronous request processing,
-`$resource` - model resource referenced by the relationship,
-`$condition` - method run condition.

> [!TIP]
> The settings are not required and must be passed if the field is running out of resource.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make(Country)
            ->updateOnPreview()
    ];
}

//...
```

<a name="with-image"></a>
## Values with picture
The `optionProperties()` method allows you to add an image to a value.

```php
optionProperties(Closure|array $data)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                1 => 'Andorra',
                2 => 'United Arab Emirates',
                //...
            ])->optionProperties(fn() => [
                1 => ['image' => 'https://moonshine-laravel.com/images/ad.png'],
                2 => ['image' => 'https://moonshine-laravel.com/images/ae.png'],
                //...
            ])
    ];
}

//...
```
![belongs to image dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="options"></a>
## Options
All choices options are available to change via *data attributes*:

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                1 => 'Andorra',
                2 => 'United Arab Emirates',
                //...
            ])->customAttributes([
                'data-max-item-count' => 2
            ])
    ];
}

//...
```

> [!TIP]
> For more details please contact [Choices](https://choices-js.github.io/Choices/).

<a name="native"></a>
## Native mode

The `native()` method disables the Choices.js library and displays select in native mode.

```php
Select::make('Type')->native()
```
