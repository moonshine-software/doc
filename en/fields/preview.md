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

<span style="background-color: #7843e9; padding: 5px; border-radius: 0.375rem">primary</span>
<span style="background-color: #ec4176; padding: 5px; border-radius: 0.375rem">secondary</span>
<span style="background-color: #00aa00; padding: 5px; border-radius: 0.375rem">success</span>
<span style="background-color: #ffdc2a; padding: 5px; border-radius: 0.375rem; color: rgb(139 116 0 / 1);">warning</span>
<span style="background-color: #e02d2d; padding: 5px; border-radius: 0.375rem">error</span>
<span style="background-color: #0079ff; padding: 5px; border-radius: 0.375rem">info</span>

<span style="background-color: rgb(243 232 255 / 1); color: rgb(107 33 168 / 1); padding: 5px; border-radius: 0.375rem">purple</span>
<span style="background-color: rgb(252 231 243 / 1); color: rgb(157 23 77 / 1); padding: 5px; border-radius: 0.375rem">pink</span>
<span style="background-color: rgb(219 234 254 / 1); color: rgb(30 64 175 / 1); padding: 5px; border-radius: 0.375rem">blue</span>
<span style="background-color: rgb(220 252 231 / 1); color: rgb(22 101 52 / 1); padding: 5px; border-radius: 0.375rem">green</span>
<span style="background-color: rgb(254 249 195 / 1); color: rgb(133 77 14 / 1); padding: 5px; border-radius: 0.375rem">yellow</span>
<span style="background-color: rgb(243 232 255 / 1); color: rgb(153 27 27 / 1); padding: 5px; border-radius: 0.375rem">red</span>
<span style="background-color: rgb(243 244 246 / 1); color: rgb(31 41 55 / 1); padding: 5px; border-radius: 0.375rem">gray</span>

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
