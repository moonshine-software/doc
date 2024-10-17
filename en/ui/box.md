# Box

- [Basics](#basics)
- [Heading](#heading)
- [Dark Style](#dark)

---

<a name="basics"></a>  
## Basics

To highlight content, you can use the `moonshine::box` component.

```php
<x-moonshine::box>
    {{ fake()->text() }}
</x-moonshine::box>
```

<a name="heading"></a>  
## Heading

The `title` parameter sets the block title.

```php
<x-moonshine::box title="Title box">
    {{ fake()->text() }}
</x-moonshine::box>
```

<a name="dark"></a>  
## Dark Style

You can set a dark style for a block by specifying the `dark` parameter with a value of `TRUE`.

````php
<x-moonshine::box :dark="true">
    {{ fake()->text() }}
</x-moonshine::box>
```
