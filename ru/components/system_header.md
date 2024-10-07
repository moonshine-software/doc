# Системный компонент Header

## Создание

Системный компонент *Header* используется для создания блока заголовка в **MoonShine**.

Вы можете создать *Header*, используя статический метод `make()` класса `Header`.

```php
make(array $components = [])
```
`$components` - массив компонентов, которые располагаются в заголовке.

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
