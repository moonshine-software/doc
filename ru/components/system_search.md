# Системный компонент Search

## Создание

Системный компонент *Search* используется для отображения формы поиска в **MoonShine**.

Вы можете создать *Search*, используя статический метод `make()` класса `Search`.

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
