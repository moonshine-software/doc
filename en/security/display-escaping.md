# Display Escaping

- [Basics](#basics)
- [Local Settings](#local-settings)
- [Components and Generated Labels](#components)
- [Blade Components](#blade)
- [Upgrading from 4.x](#migration)

---

<a name="basics"></a>
## Basics

In **MoonShine** 5.x, labels, hints, prefixes, suffixes, and strings returned by field `beforeRender()` and `afterRender()` callbacks are escaped by default.
For example, a label containing `<strong>Name</strong>` displays the tags as text instead of making the label bold.

These settings are separate from field value escaping.
The `escape()`, `unescape()`, and `escapeOnApply()` methods keep their existing purpose; `unescape()` does not enable HTML in a label or hint.
Value escaping in preview popovers also remains independent of label settings.

The `getLabel()` and `getHint()` methods return the original strings.
Display escaping does not change serialized labels, column names, card value keys, or HTML attribute escaping.

See [Configuration](/docs/{{version}}/configuration#display-escaping) for the global defaults.

<a name="local-settings"></a>
## Local Settings

Use the method for the part of the field that should display HTML.

| Display text | Enable escaping | Allow HTML |
| --- | --- | --- |
| Label | `escapeLabel()` | `unescapeLabel()` |
| Hint | `escapeHint()` | `unescapeHint()` |
| Prefix | `escapePrefix()` | `unescapePrefix()` |
| Suffix | `escapeSuffix()` | `unescapeSuffix()` |
| String before the field | `escapeBeforeRender()` | `unescapeBeforeRender()` |
| String after the field | `escapeAfterRender()` | `unescapeAfterRender()` |

Each `escape…()` method accepts `bool $escape = true`.
Passing `false` is equivalent to calling the corresponding `unescape…()` method.
An explicit local setting takes precedence over the global setting in either direction.
For example, `escapeLabel()` enables escaping for one field even when `escapes.label` is `false` globally.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel()
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint()
    ->prefix('<span>Prefix</span>')
    ->unescapePrefix()
    ->suffix('<span>Suffix</span>')
    ->unescapeSuffix()
    ->beforeRender(fn () => '<aside>Before</aside>')
    ->unescapeBeforeRender()
    ->afterRender(fn () => '<aside>After</aside>')
    ->unescapeAfterRender();
```

> [!WARNING]
> Allow HTML only for content you trust. Disabling escaping does not sanitize the string.

Objects implementing `Illuminate\Contracts\Support\Renderable`, such as views returned by `beforeRender()` or `afterRender()`, retain their rendering behavior.
Generated component markup, including field `xIf()` wrappers, continues to work.

<a name="components"></a>
## Components and Generated Labels

Components with labels, such as `ActionButton`, `Link`, `Heading`, `Box`, `Collapse`, and `Tab`, also support `escapeLabel()` and `unescapeLabel()`.
Menu elements, query tags, and handlers use the same label preference.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\ActionButton;

ActionButton::make('<strong>Open</strong>', '/articles')
    ->unescapeLabel();
```

A field's label preference is preserved in table headers, column-selection toggles, cards generated from fields, and relationship headings.
Relationship `modalMode()` buttons inherit that preference before `modifyButton` is applied.
Handler buttons similarly inherit the handler's preference before `modifyButton()` runs, so the callback can override it.

For labels in a standalone card's values list, use [Card::escapeValueLabels()](/docs/{{version}}/components/card#value-labels).

<a name="blade"></a>
## Blade Components

Pass a boolean `:escape-label` to override the global setting for a label rendered directly through Blade.

```blade
<x-moonshine::action-button :label="$label" :escape-label="false" />
<x-moonshine::heading :label="$label" :escape-label="true" />
```

The corresponding options are `:escape-hint` for `form.hint`, `:escape-prefix` for `form.input-extensions.prefix`, and `:escape-suffix` for `form.input-extensions.ext`.
Existing Blade slots remain rendered HTML; use Blade's `{{ $value }}` syntax to escape dynamic text inside a slot.
A direct `Link` component displays its label when its slot is empty; an explicit slot takes precedence.

<a name="migration"></a>
## Upgrading from 4.x

Review labels, hints, prefixes, suffixes, and field render callbacks that intentionally contain HTML strings.
Add the matching `unescape…()` method to keep that HTML rendered in 5.x.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel() // [tl! add]
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint(); // [tl! add]
```

If an application needs a different default, configure the relevant [global setting](/docs/{{version}}/configuration#display-escaping).
Use local overrides when only selected strings should render HTML.
