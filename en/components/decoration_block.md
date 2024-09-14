https://moonshine-laravel.com/docs/resource/components/components-decoration_block?change-moonshine-locale=en

------
# Decoration Block

- [Make](#make)
- [No title](#wihtout-heading)
- [Icon](#icon)

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

![block](https://moonshine-laravel.com/screenshots/block.png)
![block_dark](https://moonshine-laravel.com/screenshots/block_dark.png)

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

![block_without_title](https://moonshine-laravel.com/screenshots/block_without_title.png)
![block_without_title_dark](https://moonshine-laravel.com/screenshots/block_without_title_dark.png)

<a name="icon"></a>
### Icon

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
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons).

![block_icon](https://moonshine-laravel.com/screenshots/block_icon.png)
![block_icon_dark](https://moonshine-laravel.com/screenshots/block_icon_dark.png)
