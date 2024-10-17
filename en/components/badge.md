# Badge Component

- [Make](#make)
- [Colors](#colors)

---

<a name="make"></a>  
## Make

The *Badge* component allows you to create badges.

You can create a *Badge* using the static method `make()` class `Badge`.

```php
make(string $value = '', string $color = 'purple')
```

- `$value` - icon text
- `$color` - icon color.

```php
use MoonShine\Components\Badge;

//...

public function components(): array
{
    return [
        Badge::make(
            'new',
            'green'
        )
    ];
}

//...
```

<a name="color"></a>  
## Colors

Available colors:

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-primary">primary</span>
    <span class="badge badge-secondary">secondary</span>
    <span class="badge badge-success">success</span>
    <span class="badge badge-warning">warning</span>
    <span class="badge badge-error">error</span>
    <span class="badge badge-info">info</span>
</p>

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-purple">purple</span>
    <span class="badge badge-pink">pink</span>
    <span class="badge badge-blue">blue</span>
    <span class="badge badge-green">green</span>
    <span class="badge badge-yellow">yellow</span>
    <span class="badge badge-red">red</span>
    <span class="badge badge-gray">gray</span>
</p>
