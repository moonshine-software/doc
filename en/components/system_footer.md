# System component Footer

- [Make](#make)
- [Copyright](#copyright)
- [Menu](#menu)

---

<a name="make"></a>
## Make

The *Footer* system component is used to create a footer block in **MoonShine**.

You can create a *Footer* using the static `make()` method class `Footer`.

```php
make(array $components = [])
```

- `$components` - an array of components that are located in the footer.

```php
namespace App\MoonShine;

use App\MoonShine\Components\MyComponent;
use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make([
                MyComponent::make(),
            ])
        ]);
    }
}
```

<a name="copyright"></a>
## Copyright

The `copyright()` method allows you to design a copyright block in the footer.

```php
copyright(string|Closure $text)
```

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make()
                ->copyright(fn (): string => <<<HTML
                    &copy; 2021-2023 Made with ❤️ by
                    <a href="https://cutcode.dev"
                        class="font-semibold text-primary hover:text-secondary"
                        target="_blank"
                    >
                        CutCode
                    </a>
                HTML
                )
        ]);
    }
}
```

<a name="menu"></a>
## Menu

The `menu()` method allows you to design a block in a menu in the footer.

```php
menu(array $data)
```

- `$data` - an array of elements, where the key is the url and the value is the name of the menu item.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make()
                ->menu([
                    'https://moonshine-laravel.com/docs' => 'Documentation',
                ])
        ]);
    }
}
```

![footer](https://moonshine-laravel.com/screenshots/footer.png)
![footer_dark](https://moonshine-laravel.com/screenshots/footer_dark.png)
