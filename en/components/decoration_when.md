# Decoration When

## Make

- The *When* component allows you to display other components according to the condition.
- You can create *When* using the static `make()` method.

```php
make(Closure $condition, Closure $components, ?Closure $default = null)
```

- `$condition` - method execution condition;
- `$components` - a closure that returns an array of elements when the condition is met;
- `$default` - a closure that returns an array of default elements.

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
