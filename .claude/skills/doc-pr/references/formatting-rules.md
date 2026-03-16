# Documentation Formatting Rules

## Content Guidelines

- Write in clear, simple language without jargon.
- Highlight sections with real-world use cases and screenshots.
- All sentences must end with a period.
- Synchronize RU and EN versions line by line when possible.
- Use `**MoonShine**` for proper names with double asterisks.

## Structure Requirements

- **Title**: First element of every page using `# Title`.
- **Navigation**: For large sections, use:
  ```markdown
  - [Subtitle 1](#subtitle-1)
  - [Subtitle 2](#subtitle-2)
  ```
  Use `kebab-case` for anchor links.
- **Divider**: Add `---` after navigation.
- **Anchors**: Add before headings when using navigation:
  ```markdown
  <a name="anchor"></a>
  ## Subtitle
  ```
- **First Section**: Use "Basics" / "Основы" instead of "Start", "Introduction", etc.

## Code Examples

- Use single backtick `` ` `` for methods, classes: `setLabel()`.
- Method names must end with parentheses: `methodName()`.
- Use triple backticks with language for code blocks.
- Wrap all use statements in Torchlight collapse:
  ```php
  // torchlight! {"summaryCollapsedIndicator": "namespaces"}
  // [tl! collapse:1]
  use MoonShine\UI\Fields\Text;

  Text::make('Title')
  ```
- Use `[tl! remove]`/`[tl! add]` or `[tl! --]`/`[tl! ++]` to show code changes.
- Specify filename with: ` ```php filename:config/moonshine.php `.
- No spaces in filenames.

## Lists

```markdown
- list items end with a comma,
- a dot is placed after the last one.
```

## Alerts

```markdown
> [!NOTE]
> Simple notification.

> [!WARNING]
> Warning.

> [!TIP]
> Tips.
```

## Images

- Store in `/resources/screenshots/`.
- Link format: `https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/filename.png`.
- Add `#light` or `#dark` for theme-specific images:
  ```markdown
  ![screenshot](url#light)
  ![screenshot](url_dark#dark)
  ```

## Shortcodes

The `@include()` shortcode connects markdown partials with sprintf formatting:

```markdown
@include('_includes/partial', 'param1', 'param2')
```

## Version Placeholder

Use `{{version}}` in links:
```markdown
[Select](/docs/{{version}}/fields/select)
```
