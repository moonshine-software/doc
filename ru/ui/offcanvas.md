# Боковая панель

Компонент `moonshine::offcanvas` позволяет создавать боковые панели.

```bladehtml
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
