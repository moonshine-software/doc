https://moonshine-laravel.com/docs/resource/components/components-system_header?change-moonshine-locale=en

------

# System component Header

## Make

The *Header* system component is used to create a header block in **MoonShine**.

You can create a *Header* using the static `make()` method class `Header`.

```php
make(array $components = [])
```
`$components` - an array of components that are located in the header.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\Header;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Search;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Header::make([
                Search::make(),
            ]),

            //...
        ]);
    }
}
```
![header](https://moonshine-laravel.com/screenshots/header.png)
![header_dark](https://moonshine-laravel.com/screenshots/header_dark.png)
