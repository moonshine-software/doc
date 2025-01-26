# Decoration Block

- [Make](#make)
- [No title](#wihtout-heading)
- [Icon](#icon)

---

<a name="make"></a>
## Make

The *Block* decorator allows you to create stylized blocks.

You can create a *Block* using the static `make()` method.

```php
make(Closure|string|array $labelOrFields = '', array $fields = [])
```

```php
use MoonShine\Decorations\Block;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make('Block title', [
            Text::make('Name', 'first_name')
        ])
    ];
}

//...
```

![block](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block.png#light)
![block_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block_dark.png#dark)

<a name="no-title"></a>
## No title

If the block does not need title, then the `make()` method only has to pass an array.

```php
use MoonShine\Decorations\Block;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make([
            Text::make('Name', 'first_name')
        ])
    ];
}

//...
```

![block_without_title](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block_without_title.png#light)
![block_without_title_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block_without_title_dark.png#dark)

<a name="icon"></a>
## Icon

The `icon()` method allows you to add an icon.

```php
use MoonShine\Decorations\Block;

//...

public function components(): array
{
    return [
        Block::make('Block')
            ->icon('heroicons.outline.users')
    ];
}

//...
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](/docs/{{version}}/appearance/icons).

![block_icon](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block_icon.png#light)
![block_icon_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/block_icon_dark.png#dark)
