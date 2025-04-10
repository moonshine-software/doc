# When

The `When` component allows displaying other components based on a condition.

```php
make(
    Closure $condition,
    Closure $components,
    ?Closure $default = null
)
```

- `$condition` - the condition for executing the method,
- `$components` - a closure that returns an array of elements when the condition is met,
- `$default` - a closure that returns an array of default elements.

```php
namespace App\MoonShine\Layouts;

use MoonShine\UI\Components\When;

final class MoonShineLayout extends AppLayout
{
    public function build(): Layout
    {
        return Layout::make([
            // ...
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                When::make(
                    static fn() => config('moonshine.auth.enabled', true),
                    static fn() => [Profile::make(withBorder: true)],
                )
            ]),
        ]);
    }
}
```
