# Collapse

- [Basics](#basics)
- [Show expanded](#show)
- [Saving state](#persist)

---

<a name="basics"></a>
## Basics

The `moonshine::collapse` component allows you to collapse content.

```php
<x-moonshine::collapse title="Hide / Show">
    {{ fake()->text() }}
</x-moonshine::collapse>
```

<a name="show"></a>
## Show expanded

If the `show` parameter is `TRUE`, then by default the block will be displayed expanded.

```php
<x-moonshine::collapse title="Hide / Show" :open="true">
    {{ fake()->text() }}
</x-moonshine::collapse>
```

<a name="persist"></a>
## Saving state

If the `persist` parameter is set to `TRUE`, then the state of the block will be preserved.

```php
<x-moonshine::collapse title="Hide / Show" :persist="true">
    {{ fake()->text() }}
</x-moonshine::collapse>
```
