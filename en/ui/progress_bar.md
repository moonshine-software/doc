https://moonshine-laravel.com/docs/resource/ui-components/ui-progress_bar?change-moonshine-locale=en

------
# Progress bar

- [Basics](#basics)
- [Radial](#radial)

<a name="basics"></a>
## Basics

The `moonshine::progress-bar` component allows you to create a progress bar.

Available colors:

- ![primary](#)
- ![secondary](#)
- ![success](#)
- ![warning](#)
- ![error](#)
- ![info](#)

```php
<x-moonshine::progress-bar
    color="primary"
    :value="33"
>
    33%
</x-moonshine::progress-bar>
```

<a name="radial"></a>
## Radial

To create a radial progress indicator, you need to pass the `radial` parameter to the component with the value `TRUE`.

Available sizes:

- sm
- md
- lg
- xl

```php
<x-moonshine::progress-bar
    color="secondary"
    :radial="true"
    :value="33"
    size="md"
>
    33%
</x-moonshine::progress-bar>
```
