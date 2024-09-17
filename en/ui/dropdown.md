https://moonshine-laravel.com/docs/resource/ui-components/ui-dropdown?change-moonshine-locale=en

------
# Dropdown

- [Basics](#basics)
- [Heading](#heading)
- [Footer](#footer)
- [Location](#location)

<a name="basics"></a>
## Basics

Using the `moonshine::dropdown` component you can create drop-down blocks.


```php
<x-moonshine::dropdown>
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

<a name="heading"></a>
## Heading

```php
<x-moonshine::dropdown title="Dropdown title">
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

<a name="footer"></a>
## Footer

```php
<x-moonshine::dropdown>
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
    <x-slot:footer>Dropdown footer</x-slot:footer>
</x-moonshine::dropdown>
```

<a name="location"></a>
## Location

Available locations:

- bottom
- top
- left
- right


```php
<x-moonshine::dropdown placement="left">
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```
> [NOTE]
> Additional location options can be found in the official documentation [tippy.js](https://atomiks.github.io/tippyjs/v6/all-props/#placement).

