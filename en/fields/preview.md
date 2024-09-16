https://moonshine-laravel.com/docs/resource/fields/fields-preview?change-moonshine-locale=en

------

# Preview

- [Make](#make)
- [Badge](#badge)
- [Boolean](#boolean)
- [Link](#link)
- [Image](#image)

> [!WARNING]
> The field is not intended for entering/changing data!

<a name="make"></a>
### Make

Using the *Preview* field you can display text data from any field in the model, or generate text.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Preview', 'preview', static fn() => fake()->realText())
    ];
}

//...
```

![preview](https://moonshine-laravel.com/screenshots/preview.png)
![preview_dark](https://moonshine-laravel.com/screenshots/preview_dark.png)

<a name="badge"></a>
### Badge

The `badge()` method allows you to display a field as an icon, for example to display the status of an order.The method accepts a parameter in the form of a string or closure with an icon color.

```php
badge(string|Closure|null $color = null)
```

Available colors:

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-primary">primary</span>
    <span class="badge badge-secondary">secondary</span>
    <span class="badge badge-success">success</span>
    <span class="badge badge-warning">warning</span>
    <span class="badge badge-error">error</span>
    <span class="badge badge-info">info</span>
</p>

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-purple">purple</span>
    <span class="badge badge-pink">pink</span>
    <span class="badge badge-blue">blue</span>
    <span class="badge badge-green">green</span>
    <span class="badge badge-yellow">yellow</span>
    <span class="badge badge-red">red</span>
    <span class="badge badge-gray">gray</span>
</p>

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Status')
            ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray')
    ];
}

//...
```

<a name="boolean"></a>
### Boolean

The `boolean()` method allows you to display a field as a label (green or red) for boolean values.

```php
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
```

The `hideTrue` and `hideFalse` parameters allow you to hide the label for values.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Active')
            ->boolean(hideTrue: false, hideFalse: false)
    ];
}

//...
```

<a name="link"></a>
### Link

The `link()` method allows you to display a field as a link.

```php
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false,
)
```

- `$link` - link url,
- `$name` - link text,
- `$icon` - icon name,
- `$withoutIcon` - do not display the link icon,
- `$blank` - open the link in a new tab.

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons).

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Link')
            ->link('https://moonshine-laravel.com', blank: false),
        Preview::make('Link')
            ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Go')
    ];
}

//...
```

![preview_all](https://moonshine-laravel.com/screenshots/preview_all.png)
![preview_all_dark](https://moonshine-laravel.com/screenshots/preview_all_dark.png)

<a name="image"></a>
### Image

The `image()` method allows you to transform a url into a thumbnail with an image.

```php
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Thumb')
            ->image()
    ];
}

//...
```

![preview_image](https://moonshine-laravel.com/screenshots/preview_image.png)
![preview_image_dark](https://moonshine-laravel.com/screenshots/preview_image_dark.png)
