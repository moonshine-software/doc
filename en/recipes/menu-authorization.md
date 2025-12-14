# Display menu items based on a condition

1. Using Gate facade:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use Illuminate\Support\Facades\Gate;
use MoonShine\Support\Enums\Ability;
use MoonShine\MenuManager\MenuItem; // [tl! collapse:end]

protected function menu(): array
{
  return [
    MenuItem::make(MoonShineUserRoleResource::class)
      ->canSee(fn() => Gate::check(Ability::VIEW_ANY, MoonshineUserRole::class)),
  ];
}
```

2. Using resource:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\Ability;

protected function menu(): array
{
  return [
    MenuItem::make(MoonShineUserRoleResource::class)
      ->canSee(fn(MenuItem $item) => $item->getFiller()->can(Ability::VIEW_ANY)),
  ];
}
```

3. Without Policy:

```php
protected function menu(): array
{
    $menu = [
        MenuItem::make(ArticleResource::class),
    ];

    if (request()->user()->isSuperUser()) {
        $menu[] = MenuItem::make(MoonShineUserResource::class);
    }

    return $menu;
}
```
