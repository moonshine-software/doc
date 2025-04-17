# Preview

- [Basics](#basics)
- [View Methods](#view-methods)
  - [Badge](#badge)
  - [Boolean](#boolean)
  - [Link](#link)
  - [Image](#image)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

With the `Preview` field, you can display text data from any field in the model or generate any content.

> [!WARNING]
> The field is NOT intended for data input/modification!

```php
use MoonShine\UI\Fields\Preview;

Preview::make(
    'Preview',
    'preview',
    static fn() => fake()->realText()
)
```

![preview](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview.png#light)
![preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_dark.png#dark)

<a name="view-methods"></a>
## View Methods

<a name="badge"></a>
### Badge

The `badge()` method allows you to display the field as a badge, for example, to show the order status.
The method accepts a parameter as a string or a closure with the badge color.

```php
badge(string|Closure|null $color = null)
```

Available colors:

<p class="colors">
<span class="color color-primary">primary</span>
<span class="color color-secondary">secondary</span>
<span class="color color-success">success</span>
<span class="color color-warning">warning</span>
<span class="color color-error">error</span>
<span class="color color-info">info</span>
<span class="color color-purple">purple</span>
<span class="color color-pink">pink</span>
<span class="color color-blue">blue</span>
<span class="color color-green">green</span>
<span class="color color-yellow">yellow</span>
<span class="color color-red">red</span>
<span class="color color-gray">gray</span>
</p>

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Status')
    ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray')
```

<a name="boolean"></a>
### Boolean

The `boolean()` method allows you to display the field as a label (green or red) for boolean values.

```php
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
```

The `hideTrue` and `hideFalse` parameters allow hiding the label for the values.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Active')
    ->boolean(hideTrue: false, hideFalse: false)
```

<a name="link"></a>
### Link

The `link()` method allows you to display the field as a link.

```php
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false,
)
```

- `$link` - URL of the link,
- `$name` - text of the link,
- `$icon` - name of the icon,
- `$withoutIcon` - do not show the link icon,
- `$blank` - open the link in a new tab.

> [!NOTE]
> For more details, refer to the [Icons](/docs/{{version}}/icons) section.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Link')
    ->link('https://moonshine-laravel.com', blank: false),

Preview::make('Link')
    ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Go')
```

![preview_all](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all.png#light)
![preview_all_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_all_dark.png#dark)

<a name="image"></a>
### Image

The `image()` method allows you to convert a URL into a thumbnail with an image.

```php
use MoonShine\UI\Fields\Preview;

Preview::make('Thumb')
    ->image()
```

![preview_image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image.png#light)
![preview_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/preview_image_dark.png#dark)
