https://moonshine-laravel.com/docs/resource/fields/fields-text?change-moonshine-locale=en

------
# Text

- [Make](#make)
- [Default value](#default)
- [Only for reading](#readonly)
- [Mask](#mask)
- [Placeholder](#placeholder)
- [Extensions](#extensions)
- [Tags](#tags)
- [Editing in preview](#update-on-preview)
- [Special characters](#unescape)

<a name="make"></a>
## Make

The text field includes all the basic methods.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
    ];
}

//...
```

![input](https://moonshine-laravel.com/screenshots/input.png)
![input_dark](https://moonshine-laravel.com/screenshots/input_dark.png)

<a name="default"></a>
## Default value

You can use the `default()` method if you need to specify a default value for a field.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->default('-')
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
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->readonly()
    ];
}

//…
```

<a name="mask"></a>
## Mask

The `mask()` method is used to add a mask to a field.

```php
mask(string $mask)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->mask('7 (999) 999-99-99')
    ];
}

//...
```

![mask](https://moonshine-laravel.com/screenshots/mask.png)
![mask_dark](https://moonshine-laravel.com/screenshots/mask_dark.png)

<a name="placeholder"></a>
## Placeholder

The `placeholder()` method allows you to set *placeholder* attribute on the field.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="extensions"></a>
## Extensions

There are several extensions available for the *Text* field:

+ ability to copy a value using a button

```php
copy(string $value = '{{value}}')
```

- `{{value}}` - field value.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy(),
        Text::make('Token')
            ->copy('https://domain.com?token={{value}}')
        ];
    }

//...
```
+ lock with change blocking

```php
locked()
```

+ disable value display

```php
eye()
```

+ format hint

```php
expansion(string $ext)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy()
            ->locked()
            ->expansion('kg')
            ->eye()
        ];
    }

//...
```

![expansion](https://moonshine-laravel.com/screenshots/expansion.png)
![expansion_dark](https://moonshine-laravel.com/screenshots/expansion_dark.png)

>[!NOTE]
>The `copy` method uses the `Clipboard API` which is only available for HTTPS or localhost

You can use custom extensions, To do this, they must be added to the field via the `extension()` method.

```php
extension(InputExtension $extension)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->extension(new InputCustomExtension())
        ];
    }

//...
```

<a name="tags"></a>
## Tags

The `tags()` method allows you to enter data in the form of tags.

```php
tags(?int $limit = null)
```

- `$limit` - number of available tags, unlimited by default.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Keywords')
            ->tags()
        ];
    }

//...
```

<a name="update-on-preview"></a>
## Editing in preview

The `updateOnPreview()` method allows you to edit the *Text* field in *preview* mode.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

- `$url` - url for asynchronous request processing,
- `$resource` - model resource referenced by the relationship,
- `$condition` - method run condition.


>[!NOTE]
>The settings are not required and must be passed if the field is running out of resource.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make(Country)
            ->updateOnPreview()
    ];
}

//...
```

<a name="unescape"></a>
## Special characters

>[!WARNING]
>By default, the **Text** field and its descendants convert special characters into HTML entities when outputting values.

The `unescape()` method allows you to undo the conversion of special characters in the HTML entity when outputting values.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->unescape()
        ];
    }

//...
```
