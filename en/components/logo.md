# Logo

- [Basics](#basics)
- [Attributes](#attributes)
- [DarkMode](#darkmode)

---

<a name="basics"></a>
## Basics

The `Logo` component displays the logo of your admin panel.

```php
make(
    string $href,
    string $logo,
    ?string $logoSmall = null,
    ?string $title = null,
    bool $minimized = false,
)
```

 - `$href` - the URL for the link when clicking on the logo,
 - `$logo` - the URL to the logo image,
 - `$logoSmall` - the URL to the small version of the logo,
 - `$title` - tooltip on hover,
 - `$minimized` - interacts with [Sidebar](/docs/{{version}}/components/sidebar). If set to true, the small logo will automatically be selected.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Logo;

Logo::make(
    '/admin',
    '/vendor/moonshine/logo.svg',
    '/vendor/moonshine/logo-small.svg'
),
```
tab: Blade
```blade
<x-moonshine::layout.logo
    :href="'/admin'"
    :logo="'/vendor/moonshine/logo.svg'"
    :logoSmall="'/vendor/moonshine/logo-small.svg'"
/>
```
~~~

<a name="attributes"></a>
## Attributes

To add attributes to the `img` tag of the logo, there are two methods for the two display modes - `logoAttributes()` and `logoSmallAttributes()`.

```php
logoAttributes(array $attributes)

logoSmallAttributes(array $attributes)
```

<a name="darkmode"></a>
## DarkMode

You can specify logos for the dark theme separately.
To do this, use the `darkMode()` method.

```php
darkMode(string $logo, ?string $small = null)
```

```php
protected function getLogoComponent(): Logo
{
    return parent::getLogoComponent()
        ->darkMode(
            asset('logo-dark.svg'),
            asset('logo-dark-small.svg'),
        );
}
```
