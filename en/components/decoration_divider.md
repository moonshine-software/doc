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

![divider](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider.png)
![divider_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_dark.png)

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

![divider_label](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label.png)
![divider_label_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_dark.png)

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

![divider_label_center](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_center.png)
![divider_label_center_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/divider_label_center_dark.png)

