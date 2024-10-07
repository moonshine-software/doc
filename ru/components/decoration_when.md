# Декоратор When

## Создание

- Компонент *When* позволяет отображать другие компоненты в соответствии с условием.
- Вы можете создать *When*, используя статический метод `make()`.

```php
make(Closure $condition, Closure $components, ?Closure $default = null)
```

- `$condition` - условие выполнения метода;
- `$components` - замыкание, которое возвращает массив элементов при выполнении условия;
- `$default` - замыкание, которое возвращает массив элементов по умолчанию.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\{LayoutBlock, LayoutBuilder, Menu, Profile, Sidebar};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                When::make(
                    static fn() => config('moonshine.auth.enable', true),
                    static fn() => [Profile::make(withBorder: true)]
                )
            ]),

            //...
        ]);
    }
}
```
