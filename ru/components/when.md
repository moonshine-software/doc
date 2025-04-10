# When

Компонент `When` позволяет отображать другие компоненты в соответствии с условием.

```php
make(
    Closure $condition,
    Closure $components,
    ?Closure $default = null
)
```

- `$condition` - условие выполнения метода,
- `$components` - замыкание, которое возвращает массив элементов при выполнении условия,
- `$default` - замыкание, которое возвращает массив элементов по умолчанию.

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
