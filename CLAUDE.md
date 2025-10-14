# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **MoonShine** documentation repository. MoonShine is a Laravel admin panel framework that uses Blade, TailwindCSS, and AlpineJS. The documentation is written in Markdown and maintained in both English (`en/`) and Russian (`ru/`) versions.

## Repository Structure

```
├── en/                      # English documentation
│   ├── advanced/           # Advanced topics
│   ├── appearance/         # UI customization (menu, layout, assets, colors, icons)
│   ├── components/         # Component documentation
│   ├── fields/             # Field types documentation
│   ├── frontend/           # Frontend (JS, SDUI, API)
│   ├── model-resource/     # ModelResource documentation
│   ├── page/               # Pages documentation
│   ├── recipes/            # Code recipes and examples
│   ├── security/           # Authorization and authentication
│   └── _includes/          # Reusable markdown partials
├── ru/                      # Russian documentation (mirrors en/ structure)
├── resources/
│   └── screenshots/        # Documentation screenshots
├── navigation.md           # Documentation navigation structure
└── README.md               # Documentation writing guidelines
```

## Documentation Standards

The documentation follows strict formatting rules defined in `README.md`. Key principles:

### Content Guidelines

- Write in clear, simple language without jargon.
- Highlight sections with real-world use cases and screenshots.
- All sentences must end with a period.
- Synchronize RU and EN versions line by line when possible.
- Use `**MoonShine**` for proper names with double asterisks.

### Structure Requirements

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
- **First Section**: Use "Basics" instead of "Start", "Introduction", etc.

### Code Examples

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

### Lists

```markdown
- list items end with a comma,
- a dot is placed after the last one.
```

### Alerts

```markdown
> [!NOTE]
> Simple notification.

> [!WARNING]
> Warning.

> [!TIP]
> Tips.
```

### Images

- Store in `/resources/screenshots/`.
- Link format: `https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/filename.png`.
- Add `#light` or `#dark` for theme-specific images:
  ```markdown
  ![screenshot](url#light)
  ![screenshot](url_dark#dark)
  ```

### Shortcodes

The `@include()` shortcode connects markdown partials with sprintf formatting:

```markdown
@include('_includes/partial', 'param1', 'param2')
```

## Working with Documentation

### When Adding New Sections

1. Add to both `en/` and `ru/` directories.
2. Update `navigation.md` with the new section link.
3. Follow the structure: title → navigation → divider → anchored sections.
4. Ensure RU and EN versions are synchronized.

### When Editing Existing Documentation

1. Read the existing content to understand the structure.
2. Check both RU and EN versions for consistency.
3. Preserve all Torchlight formatting in code examples.
4. Maintain the same tone and style as surrounding documentation.
5. Verify all anchors and internal links still work.

### Pull Request Checklist

From `.github/pull_request_template.md`:

```markdown
- Issue #<!-- add issue number here -->
- Lang
  - [ ] En
  - [ ] Ru
```

Always update both language versions when making documentation changes.

## Main Branch

The current main branch is `4.x` (for MoonShine v4).

## Development Environment

This is a documentation-only repository. For working with the actual MoonShine package:

1. Clone the demo project: `git clone git@github.com:moonshine-software/demo-project.git`
2. Set up packages directory and clone MoonShine
3. Configure composer.json with local path repository
4. Install dependencies and run migrations

See `en/contribution.md` for full developer setup instructions.

## Version Placeholders

Documentation uses `{{version}}` as a placeholder in links:
```markdown
[Select](/docs/{{version}}/fields/select)
```

This gets replaced with the actual version (e.g., `4.x`) during documentation rendering.

## Key Documentation Sections

- **Getting Started**: Installation, configuration, quick start
- **Appearance**: Menu, layout, assets, colors, icons
- **ModelResource**: Core CRUD functionality, fields, forms, tables
- **Fields**: All field types including relationships
- **Components**: UI components (Blade + Alpine)
- **Advanced**: Controllers, commands, handlers, testing, package development
- **Recipes**: Practical examples and common patterns
- **Security**: Authentication and authorization

## Important Notes

- This repository contains ONLY documentation (Markdown files).
- The actual MoonShine source code is in a separate repository.
- Documentation quality is considered foundational to the product.
- Always maintain both EN and RU versions in parallel.
- Follow README.md guidelines strictly for consistency.
