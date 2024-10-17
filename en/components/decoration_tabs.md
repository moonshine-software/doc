# Tabs

  - [Make](#make)
  - [Vertical display of the tabs.](#vertical-tab)
  - [Active tab](#active-tab)
  - [Icon](#tab-icon)
  - [Tab ID](#tab-id)

---

<a name="make"></a>
## Make
The *Tabs* component allows you to create tabs.

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                Text::make('Seo title')

                //...
            ]),
            Tab::make('Categories', [
                //...
            ])
        ])
    ];
}

//...
```

![tabs](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tabs.png)
![tabs_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tabs_dark.png)

<a name="vertical-tab"></a>
## Vertical display of the tabs.

The method `vertical()` allows you to display tabs in vertical mode.

```php
vertical(Closure|bool|null $condition = null)
```

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Categories', [
                //...
            ])
        ])->vertical()
    ];
}
//...
```

![tabs_vertical](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tabs_vertical.png)
![tabs_vertical_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tabs_vertical_dark.png)

By default, the minimum width of a tabbed block at which the inline display changes is `480px`. You can change the minimum width value via the method `customAttributes()`:

```php
Tabs::make([
        //...
    ])
    ->customAttributes([
        'data-tabs-vertical-min-width' => 600
    ])
```

<a name="active-tab"></a>
## Active tab

The method `active()` allows you to specify which tab should be active by default.

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Categories', [
                //...
            ])
                ->active()
        ])
    ];
}

//...
```

<a name="tab-icon"></a>
## Icon

```php
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Categories', [
                //...
            ])
                ->icon('heroicons.outline.pencil')
        ])
    ];
}

//...
```

<a name="tab-id"></a>
## Tab ID

The `uniqueId()` method allows you to set the tab ID.
This way you can implement your own logic for tabs using **Alpine.js**.

```php
uniqueId(string $id)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Tab 1', [
                //...

                ActionButton::make('Go to tab 2')->onClick(fn() => 'setActiveTab(`my-tab-2`)', 'prevent'),
            ])
                ->uniqueId('my-tab-1'),

            Tab::make('Tab 2', [
                //...

                ActionButton::make('Go to tab 1')->onClick(fn() => 'setActiveTab(`my-tab-1`)', 'prevent'),
            ])
                ->uniqueId('my-tab-2')
        ])
    ];
}

//...
```