# System component Search

## Make

The *Search* system component is used to display the search form in **MoonShine**.

You can create a *Search* using the static `make()` method class `Search`.

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
                Search::make()
            ]),

            //...
        ]);
    }
}
```

![search_component](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/search_component.png)
![search_component_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/search_component_dark.png)
