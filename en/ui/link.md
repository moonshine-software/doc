https://moonshine-laravel.com/docs/resource/ui-components/ui-link?change-moonshine-locale=en

------
# Link

  - [Basics](#basics)
  - [Fill](#fill)
  - [Icon](#icon)

<a name="basics"></a>
## Basics

To create a stylized link, you can use the `moonshine::link-button` components or ``moonshine::link-native`.

```php
<x-moonshine::link-button href="#">Link</x-moonshine::link-button>

<x-moonshine::link-native href="#">Link</x-moonshine::link-native>
```

<a name="fill"></a>
## Fill

The `filled` parameter is responsible for filling.

```php
<x-moonshine::link-button
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-button>

<x-moonshine::link-native
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-native>
```

<a name="icon"></a>
## Icon

You can pass the `icon` parameter.

```php
<x-moonshine::link-button
    href="#"
    icon="heroicons.arrow-top-right-on-square"
>
    Link
</x-moonshine::link-button>

<x-moonshine::link-native
    href="#"
    icon="heroicons.arrow-top-right-on-square"
>
    Link
</x-moonshine::link-native>
```

> [!NOTE]
> All available [icons](https://moonshine-laravel.com/docs/resource/appearance/icons) .
