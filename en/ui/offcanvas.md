https://moonshine-laravel.com/docs/resource/ui-components/ui-offcanvas?change-moonshine-locale=en

------

## Offcanvas

The `moonshine::offcanvas` component allows you to create sidebars.

```php
<x-moonshine::offcanvas
    title="Offcanvas"
    :left="false"
>
    <x-slot:toggler>
         Open
    </x-slot:toggler>
    {{ fake()->text() }}
</x-moonshine::offcanvas>
```

