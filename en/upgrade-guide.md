---
title: Upgrade guide
---

# Upgrade Guide

- [Upgrading To 5.0 From 4.x](#upgrade-5-0)

<a name="high-impact-changes"></a>
## High Impact Changes

- [Updating Dependencies](#update-dependencies)
- [Filters, Query Tags and Handlers](#index-page)
- [Display Escaping](#display-escaping)

<a name="medium-impact-changes"></a>
## Medium Impact Changes

- [Removed Classes](#removed-classes)
- [Import and Export](#import-export)
- [Overridden Views](#views)

<a name="low-impact-changes"></a>
## Low Impact Changes

- [Configuration Values](#config-values)
- [Field Value Escaping](#value-escaping)
- [File Extensions](#file-extensions)
- [Link URLs](#link-urls)
- [Table Skeleton and Loader](#tables)
- [Popover Editing](#popover)
- [Request Wrapper](#request)
- [Dropdowns](#dropdowns)
- [Contracts](#contracts)

---

<a name="upgrade-5-0"></a>
## Upgrading To 5.0 From 4.x

#### Estimated Upgrade Time: 30 Minutes

We attempt to document every possible breaking change.
Since some of these breaking changes are in obscure parts of **MoonShine**, only a portion of these changes may actually affect your application.

> [!NOTE]
> This guide is in progress and will be extended before the 5.0 release.
> For upgrading from 3.x, follow the [4.x upgrade guide](/docs/4.x/upgrade-guide) first.

<a name="update-dependencies"></a>
### Updating Dependencies

**Likelihood Of Impact: High**

**MoonShine** 5.0 requires PHP 8.4 or newer and Laravel 11, 12 or 13.
Laravel 10 is no longer supported.

You should update the following dependencies in your application's `composer.json` file:

- `moonshine/moonshine` to `^5.0`,
- `moonshine/import-export` to `^3.0`, if you use [import and export](#import-export).

```shell
composer update
```

**MoonShine** 5.0 requires `symfony/http-foundation` and `symfony/psr-http-message-bridge` 7.4 or 8.1.
If Composer cannot resolve them because older versions are locked, update with dependencies:

```shell
composer update moonshine/moonshine -W
```

<a name="resources"></a>
### Resources

<a name="index-page"></a>
#### Filters, Query Tags and Handlers

**Likelihood Of Impact: High**

The `HasFilters`, `HasQueryTags` and `HasHandlers` traits have been removed from `ModelResource`.
Filters, query tags and handlers are configured only in `IndexPage`.

Move the following methods from the resource to its index page:

- `filters()`,
- `queryTags()`,
- `handlers()`,
- `getIgnoredFields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Resources\Post\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    protected function filters(): iterable
    {
        return [
            Text::make('Title', 'title'),
        ];
    }

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                'Published',
                static fn ($query) => $query->where('is_published', true)
            ),
        ];
    }
}
```

The resource-level `hasFilters()`, `getFilters()`, `hasQueryTags()`, `getQueryTags()`, `hasHandlers()` and `getHandlers()` methods have been removed as well.
Call them on the index page instead.

```php
$resource->getFilters(); // [tl! remove]
$resource->getIndexPage()?->getFilters(); // [tl! add]
```

Filter values and the saved query state are still read from the resource, for example with `getFilterParams()`.

See [Filters](/docs/{{version}}/model-resource/filters), [Query Tags](/docs/{{version}}/model-resource/query-tags) and [Handlers](/docs/{{version}}/advanced/handlers) for details.

<a name="import-export"></a>
#### Import and Export

**Likelihood Of Impact: Medium**

**MoonShine** 5.0 works with `moonshine/import-export` 3.x.

The `ImportExportConcern` trait and the `HasImportExportContract` interface stay on the resource, together with the import and export fields.
The buttons are now handlers of the index page, so add the `ImportExportHandlersConcern` trait to it.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources\Category\Pages;

use MoonShine\ImportExport\Traits\ImportExportHandlersConcern;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class CategoryIndexPage extends IndexPage
{
    use ImportExportHandlersConcern;
}
```

Move overrides of the `import()`, `export()`, `isExportToCsv()` and `handlers()` methods from the resource to the index page.
Inside the page, use `getResource()` to access the resource.

<a name="escaping"></a>
### Escaping

<a name="display-escaping"></a>
#### Display Escaping

**Likelihood Of Impact: High**

Labels, hints, prefixes, suffixes and strings returned by the field `beforeRender()` and `afterRender()` callbacks are now escaped by default.
A label such as `<strong>Name</strong>` is displayed as text.

Add the matching `unescape…()` method where HTML is intended.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel() // [tl! add]
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint(); // [tl! add]
```

The defaults can be changed in the `escapes` section of the configuration.

```php filename:config/moonshine.php
'escapes' => [
    'label' => true,
    'hint' => true,
    'prefix' => true,
    'suffix' => true,
    'before_render' => true,
    'after_render' => true,
],
```

Field link names, related record labels and modal titles are escaped regardless of these settings.
Use `unescapeLinkName()`, `unescapeOptionLabels()` and `unescapeTitle()` to allow HTML in them.

Values implementing `Illuminate\Contracts\Support\Htmlable`, such as `HtmlString`, are output as prepared HTML.

> [!WARNING]
> Allow HTML only for content you trust. Disabling escaping does not sanitize the string.

See [Display Escaping](/docs/{{version}}/security/display-escaping) for all settings.

<a name="value-escaping"></a>
#### Field Value Escaping

**Likelihood Of Impact: Low**

Field values of `Text`, `Textarea` and `BelongsTo` are still escaped by default.
The new `escapes.value` and `escapes.value_on_apply` settings change this default globally, so no changes are needed if you keep them enabled.

```php filename:config/moonshine.php
'escapes' => [
    // ...
    'value' => true,
    'value_on_apply' => true,
],
```

If your field uses the `WithEscapedValue` trait and redeclares the `$unescape` property, change its type to `?bool`.
`null` means that the field follows the global setting.

```php
protected bool $unescape = false; // [tl! remove]
protected ?bool $unescape = null; // [tl! add]
```

Calling `escapeOnApply()` without an argument now always enables escaping on apply, even when `escapes.value_on_apply` is disabled.
See [Text](/docs/{{version}}/fields/text#unescape) for field-level settings.

<a name="popover"></a>
#### Popover Editing

**Likelihood Of Impact: Very Low**

Popover editing with `updateOnPreview()` now escapes the value unless the field implements `MoonShine\UI\Contracts\HasEscapedValueContract` and calls `unescape()`.
Built-in `Text`, `Textarea` and `BelongsTo` fields implement it.
A custom field that uses the `WithEscapedValue` trait should implement this contract to keep unescaped values in the popover.

<a name="fields-components"></a>
### Fields and Components

<a name="views"></a>
#### Overridden Views

**Likelihood Of Impact: Medium**

Many component views changed in 5.0. If your application has published and changed any of the views below, compare them with the new versions and update them.

Views that display labels, hints and titles now print values prepared in PHP, such as `$labelHtml`, `$hintHtml`, `$titleHtml` and `$valueHtml`, which already follow the [display escaping](#display-escaping) settings.
A published copy that prints `{!! $label !!}` bypasses escaping, and a copy that prints `{{ $label }}` ignores `unescapeLabel()`.

- `moonshine::components.card`, `collapse`, `field-container`, `heading`, `modal`, `off-canvas`, `tabs`,
- `moonshine::components.form.fieldset`, `form.hint`, `form.wrapper`, `form.input-extensions.ext`, `form.input-extensions.prefix`,
- `moonshine::components.layout.box`, `layout.divider`, `layout.footer`,
- `moonshine::components.link-button`, `link-native`,
- `moonshine::components.menu.divider`, `menu.group`, `menu.item-link`,
- `moonshine::components.metrics.value`, `metrics.wrapped.value`,
- `moonshine::components.table.index`,
- `moonshine::fields.fieldset`, `fields.relationships.belongs-to-many`.

Several frequently rendered views now output their elements directly instead of nesting other Blade components.
Their data is also prepared in PHP, for example `$tagAttributes` and `$labelHtml` in the action button view.

- `moonshine::components.action-button`,
- `moonshine::components.form.builder`,
- `moonshine::components.icon`,
- `moonshine::components.rating`,
- `moonshine::fields.hidden`.

Default rows of vertical tables, such as on `DetailPage`, are rendered with the new `moonshine::components.table.vertical-field` view.
They no longer use the `layout.grid`, `layout.column` and `layout.div` views, so overrides of those views do not affect them.
Override `moonshine::components.table.vertical-field` instead.
Rows customized with the `title` or `value` closures of `vertical()` still use the components.

<a name="file-extensions"></a>
#### File Extensions

**Likelihood Of Impact: Low**

`File` and `Image` fields inherit the new global `allowed_extensions` list unless `allowedExtensions()` is called on the field.
The default `[]` allows all extensions, so no changes are needed for existing applications.

If your field class extends `File` or `Image` and redeclares the `$allowedExtensions` property, change its type to `?array`.
`null` means that the field follows the global list.

```php
protected array $allowedExtensions = ['pdf']; // [tl! remove]
protected ?array $allowedExtensions = ['pdf']; // [tl! add]
```

The `allowedExtensions()` method of `MoonShine\UI\Contracts\FileableContract` now accepts `array|string`.
Update its signature in your own implementations and overrides.

```php
public function allowedExtensions(array $allowedExtensions): static // [tl! remove]
public function allowedExtensions(array|string $allowedExtensions): static // [tl! add]
```

The default `accept` attribute is now added when the field is rendered, so `getAttribute('accept')` returns `null` before rendering unless `accept()` or `allowedExtensions()` was called on the field.
See [File](/docs/{{version}}/fields/file#allowed-extensions) for details.

<a name="link-urls"></a>
#### Link URLs

**Likelihood Of Impact: Low**

The `Link` component and the links of the `Url` field now allow only the `http`, `https`, `mailto` and `tel` schemes, as well as relative URLs and anchors.
Links with other schemes, such as `javascript:` or `ftp:`, are rendered with `href="#"`.
The link text is not changed.

<a name="tables"></a>
#### Table Skeleton and Loader

**Likelihood Of Impact: Low**

The skeleton and the loader are rendered only for asynchronous tables.
The `skeleton()` and `loader()` methods have no effect on synchronous tables.

<a name="dropdowns"></a>
#### Dropdowns

**Likelihood Of Impact: Very Low**

The Popper instance of a dropdown is created when the dropdown is opened for the first time.
Until then, the `popperInstance` property of the `dropdown` Alpine component is `null`.
Check it before calling its methods from your own JavaScript.

<a name="deprecated-apis"></a>
### Deprecated APIs

<a name="removed-classes"></a>
#### Removed Classes

**Likelihood Of Impact: Medium**

The classes deprecated in 4.x have been removed.

| Class                                                                 | Replacement                                                        |
|-----------------------------------------------------------------------|--------------------------------------------------------------------|
| `MoonShine\Laravel\Handlers\Handler`                                  | `MoonShine\Crud\Handlers\Handler`                                  |
| `MoonShine\Laravel\Handlers\Handlers`                                 | `MoonShine\Crud\Handlers\Handlers`                                 |
| `MoonShine\Laravel\Notifications\NotificationButton`                  | `MoonShine\Crud\Notifications\NotificationButton`                  |
| `MoonShine\Laravel\Http\Responses\MoonShineJsonResponse`              | `MoonShine\Crud\JsonResponse`                                      |
| `MoonShine\Laravel\Http\Requests\Relations\AsyncSearchRequest`        | `MoonShine\Laravel\Http\Requests\Relations\RelationModelFieldRequest` |
| `MoonShine\Laravel\MoonShineUI`                                       | The `toast()` helper instead of `MoonShineUI::toast()`             |

```php
use MoonShine\Laravel\Handlers\Handler; // [tl! remove]
use MoonShine\Crud\Handlers\Handler; // [tl! add]

use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse; // [tl! remove]
use MoonShine\Crud\JsonResponse; // [tl! add]

MoonShineUI::toast('Saved'); // [tl! remove]
toast('Saved'); // [tl! add]
```

<a name="configuration"></a>
### Configuration

<a name="config-values"></a>
#### Configuration Values

**Likelihood Of Impact: Low**

Configuration values are now validated when they are read, and an invalid value raises a `TypeError`.

- `middleware`, `auth.pipelines` and `pages` must be arrays of strings, such as class names.
  Closures and objects in `auth.pipelines` are no longer accepted, so register each pipeline as a class.
- `pages` must contain page classes, `layout` must extend `MoonShine\Crud\Layouts\AbstractLayout`,
  and `palette` must implement `MoonShine\Contracts\ColorManager\PaletteContract`.

```php filename:config/moonshine.php
'auth' => [
    'pipelines' => [
        static fn ($request, $next) => $next($request), // [tl! remove]
        \App\MoonShine\AuthPipelines\TwoFactorAuthentication::class, // [tl! add]
    ],
],
```

<a name="extending"></a>
### Extending MoonShine

<a name="request"></a>
#### Request Wrapper

**Likelihood Of Impact: Very Low**

The `$request` property of `MoonShine\Core\AbstractRequest` is now `ServerRequestInterface|Closure`.
The PSR request is created lazily when input is read.

If your class extends `AbstractRequest` and reads `$this->request` directly, use the `getRequest()` method instead.

```php
$this->request->getQueryParams(); // [tl! remove]
$this->getRequest()->getQueryParams(); // [tl! add]
```

<a name="contracts"></a>
#### Contracts

**Likelihood Of Impact: Very Low**

If your classes implement **MoonShine** contracts directly instead of extending the base classes, add the new methods:

- `MoonShine\Contracts\UI\ComponentContract`: `when()` and `unless()`, for example with the `Illuminate\Support\Traits\Conditionable` trait,
- `MoonShine\Contracts\Core\DependencyInjection\TranslatorContract`: `getString()`,
- `MoonShine\Contracts\Core\HasResourceContract`: `getResourceOrFail()`, provided by the `MoonShine\Core\Traits\HasResource` trait,
- `MoonShine\Crud\Contracts\Notifications\NotificationButtonContract`: `toArray()`.

`RequestContract::getScalar()` now returns `string|int|float|bool|null` instead of `mixed`. Update the return type in your own implementations.

New escaping contracts, such as `HasLabelEscapingContract` or `HasEscapedValueContract`, are optional.
