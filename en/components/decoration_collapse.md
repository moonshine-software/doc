# Decoration Collapse

  - [Make](#make)
  - [Icon](#icon)
  - [Show](#show)
  - [Persist](#persist)

---

<a name="make"></a> 
## Make

The *Collapse* decorator allows you to collapse the block contents while maintaining the state.

```php
make(Closure|string|array $labelOrFields = '', array $fields = [])
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Title/Slug', [
            Text::make('Title'),
            Text::make('Slug')
        ])
    ];
}

//...
```

![collapse](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/collapse.png)
![collapse_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/collapse_dark.png)

<a name="icon"></a> 
## Icon

The `icon()` method allows you to add an icon.

```php
use MoonShine\Decorations\Collapse;

//...

public function components(): array
{
    return [
        Collapse::make('Collapse')
            ->icon('heroicons.outline.users')
    ];
}

//...
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons) .

![collapse_icon](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/collapse_icon.png)
![collapse_icon_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/collapse_icon_dark.png)

<a name="show"></a> 
## Show

By default, the *Collapse* decorator is displayed as collapsed.The `show()` method allows you to override this behavior.

```php
show(bool $show = true)
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Collapse::make('Title/Slug', [
            Text::make('Title'),
            Text::make('Slug')
        ])
            ->show()
    ];
}

//...
```

<a name="persist"></a> 
## Persist

By default, the *Collapse* remembers the state, but there are times when it is not worth doing this.The `persist()` method allows you to override this behavior.

```php
persist(Closure|bool|null $condition = null)
```

```php
use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Text;
 
//...
 
public function components(): array
{
return [
    Collapse::make('Title/Slug', [
        Text::make('Title'),
        Text::make('Slug')
    ])
        ->persist(fn () => false) 
    ];
}
 
//…
```
