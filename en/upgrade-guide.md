---
title: Upgrade guide
---

# MoonShine Upgrade Guide 3.x → 4.0

- [Updating Dependencies](#update-dependencies)
- [Namespace Changes](#namespace-changes)
- [Resource Changes](#resource-changes)
- [Field Changes](#field-changes)
- [Layout Changes](#layout-changes)
- [Deprecated Classes and Methods](#deprecated)
- [Async Methods](#async-methods)

---

<a name="update-dependencies"></a>
## Package Update

Change the package version to composer.json and update dependencies.

```json
{
    "require": {
        "moonshine/moonshine": "^4.0"
    }
}
```

```shell
composer update
```

<a name="namespace-changes"></a>
## Namespace Changes

```php
use MoonShine\Laravel\Forms\FiltersForm; // [tl! remove]
use MoonShine\Crud\Forms\FiltersForm; // [tl! add]

use MoonShine\Laravel\Forms\LoginForm; // [tl! remove]
use MoonShine\Crud\Forms\LoginForm; // [tl! add]

use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse; // [tl! remove]
use MoonShine\Crud\JsonResponse; // [tl! add]

use MoonShine\Laravel\MoonShineRequest; // [tl! remove]
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract; // [tl! add]

use MoonShine\Laravel\Enums\Action; // [tl! remove]
use MoonShine\Support\Enums\Action; // [tl! add]

use MoonShine\Laravel\Enums\Ability; // [tl! remove]
use MoonShine\Support\Enums\Ability; // [tl! add]

use MoonShine\Laravel\Traits\WithComponentsPusher; // [tl! remove]
use MoonShine\Crud\Traits\WithComponentsPusher; // [tl! add]
```

<a name="resource-changes"></a>
## Changes in resource structures

Many methods and properties have been moved from resources to the corresponding CRUD pages.

The `rules()` method has been moved from the resource to the `FormPage`.

The methods `metrics()`, `queryTags()`, `filters()`, etc. have been moved to `IndexPage`.

The `indexButtons()` method has been removed from the resource, and the `buttons()` method in the corresponding index page should be used instead.

This is not a complete list of changes in the resource,
but the process of transferring all the relevant functionality from the resource to CRUD pages is quite intuitive and should not be difficult.

<a name="field-changes"></a>
## Field Changes

Removed the `StackFields` field, the `Fieldset` field should be used instead.

```php
StackFields::make('Title', [ // [tl! remove]
    Text::make('Field 1'), // [tl! remove]
    Text::make('Field 2'), // [tl! remove]
]) // [tl! remove]

Fieldset::make('Title', [ // [tl! add]
    Text::make('Field 1'), // [tl! add]
    Text::make('Field 2'), // [tl! add]
]) // [tl! add]
```

<a name="layout-changes"></a>
## Layout Changes

### CompactLayout Removed

The `CompactLayout` has been removed. If you used this layout, go for the standard `AppLayout` extends.

```php
use MoonShine\Laravel\Layouts\CompactLayout; // [tl! remove]
use MoonShine\Laravel\Layouts\AppLayout; // [tl! add]
```

### New Palettes

A palette system has been introduced for managing color schemes. `PurplePalette` is used by default.

For more information about working with palettes, see the [**Color Manager**](/docs/{{version}}/appearance/colors) section.

### MenuItem Changes

The parameters in the `MenuItem::make()` method have swapped places, now `$filler` comes first, then `$label`.

The `$label` parameter is now optional, by default it is taken from the `getLabel()` method of the filler.

```php
MenuItem::make('Settings', SettingResource::class) // [tl! remove]
MenuItem::make(SettingResource::class) // [tl! add]
```

<a name="deprecated"></a>
## Deprecated Classes and Methods

The following classes and methods are deprecated and will be removed in version 5.0.

### Deprecated Classes

| Class                                                    | Replacement                                            |
|----------------------------------------------------------|--------------------------------------------------------|
| `MoonShine\Laravel\Notifications\NotificationButton`     | `MoonShine\Crud\Notifications\NotificationButton`      |
| `MoonShine\Laravel\Http\Responses\MoonShineJsonResponse` | `MoonShine\Crud\JsonResponse`                          |
| `MoonShine\Laravel\MoonShineUI`                          | Instead of `MoonShineUI::toast()` now helper `toast()` |
| `MoonShine\Laravel\Handlers\Handlers`                    | `MoonShine\Crud\Handlers\BaseHandlers`                 |
| `MoonShine\Laravel\Handlers\Handler`                     | `MoonShine\Crud\Handlers\BaseHandler`                  |

### Deprecated Methods in ModelResource

| Method               | Replacement          |
|----------------------|----------------------|
| `getIgnoredFields()` | Moved to `IndexPage` |
| `filters()`          | Moved to `IndexPage` |
| `hasFilters()`       | Moved to `IndexPage` |
| `queryTags()`        | Moved to `IndexPage` |
| `hasQueryTags()`     | Moved to `IndexPage` |
| `handlers()`         | Moved to `IndexPage` |
| `hasHandlers()`      | Moved to `IndexPage` |
| `getHandlers()`      | Moved to `IndexPage` |

### Deprecated Traits

| Trait          | Replacement          |
|----------------|----------------------|
| `HasFilters`   | Moved to `IndexPage` |
| `HasQueryTags` | Moved to `IndexPage` |
| `HasHandlers`  | Moved to `IndexPage` |

> [!WARNING]
> All listed classes and methods will be completely removed in version 5.0. It is recommended to migrate to new alternatives.

<a name="async-methods"></a>
## Async Methods

All async methods need the `#[AsyncMethod]` attribute.

Async methods now support "DI".

```php
use MoonShine\Crud\JsonResponse;
use MoonShine\Support\Attributes\AsyncMethod;

class MyPage extends Page
{
    #[AsyncMethod]
    public function someAsyncMethod(JsonResponse $response): JsonResponse
    {
        return $response->toast('Loaded successfully');
    }
}
```
