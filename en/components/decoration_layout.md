# Decoration Layout

- [Flex](#flex)
- [Grid/Column](#grid-column)

---

Sometimes, for ease of perception, it is necessary to divide the form into several blocks. By default they are located one below the other, but with the help of `Layout` decorations you can easily change the display order.

<a name="flex"></a>  
## Flex

The *Flex* decoration gives elements the appropriate positioning.

```php
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
    ];
}

//...
```

![Flex](https://moonshine-laravel.com/screenshots/flex.png)
![Flex Dark](https://moonshine-laravel.com/screenshots/flex_dark.png)

#### Additional options

```php
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
            ->withoutSpace() // Eliminate indentation
            ->justifyAlign('start') // Based on tailwind classes justify-[param]
            ->itemsAlign('start') // Based on tailwind classes items-[param]
    ];
}

//...
```

<a name="grid-column"></a>  
## Grid/Column

The *Grid* and *Column* decorators allow you to organize a grid with columns.

The `columnSpan()` method allows you to set the width of a block in a *Grid*.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

`$columnSpan` - relevant for desktop version,
`$adaptiveColumnSpan` - relevant for the mobile version.

```php
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;

//...
public function components(): array
{
    return [
        Grid::make([
            Column::make([
                // ...
            ])
                ->columnSpan(6),

            Column::make([
                // ...
            ])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> The **MoonShine** admin panel uses a 12-column grid.

![Grid](https://moonshine-laravel.com/screenshots/grid.png)
![Grid Dark](https://moonshine-laravel.com/screenshots/grid_dark.png)
