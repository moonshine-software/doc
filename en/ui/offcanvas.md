# Offcanvas

The `moonshine::offcanvas` component allows you to create sidebars.

```blade
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

