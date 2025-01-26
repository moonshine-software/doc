# Decoration Divider

- [Make](#make)
- [Label](#label)
- [Centering](#Centering)

---

<a name="make"></a>
## Make

To divide into zones, you can use the *Divider* decoration.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make(),

        //...
    ];
}
```

![divider](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider.png#light)
![divider_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_dark.png#dark)

<a name="label"></a>
## Label

You can use text as a delimiter; to do this, you need to pass it to the `make()` method.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make('Divider'),

        //...
    ];
}
```

![divider_label](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label.png#light)
![divider_label_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_dark.png#dark)

<a name="centering"></a>
## Centering

The `centered()` method allows you to center the text.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make('Divider')
            ->centered(),

        //...
    ];
}
```

![divider_label_center](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_center.png#light)
![divider_label_center_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_center_dark.png#dark)

