---
allowed-tools: Web-fetch, Web-search, Bash(gh pr view:*), Bash(gh pr diff:*), Bash(git checkout:*)
description: Generate documentation by PR link or PR ID
argument-hint: [pr link or pr id]
---

User provided Pull Request URL or ID: {{$1}}

Your task: analyze the PR and create/update MoonShine documentation.

## Critical Rules

> [!WARNING]
> **DO NOT FABRICATE!** If you are uncertain about something or lack information:
> 1. Search for information in `.context/moonshine` (MoonShine codebase)
> 2. Use WebSearch/WebFetch to find current information
> 3. Ask the user via AskUserQuestion

## Step-by-Step Plan

1. **Retrieve PR Information**
   - Use `gh pr view {{$1}}` to get PR details
   - Study changes in the PR via `gh pr diff {{$1}}`
   - Understand the context: is it a new feature, enhancement, or fix?

2. **Create Git Branch**
   - Based on the PR content, determine the section name (e.g., "rating-component", "new-field-type", etc.)
   - Create a new git branch with a descriptive name: `git checkout -b docs/section-name`
   - Use kebab-case for branch naming
   - Branch name should reflect the documentation section being created/updated

3. **Study Documentation Formatting Rules**
   - Read the file `@/README.ru.md`
   - This is a mandatory file with formatting and structure rules
   - Follow all rules from there

4. **Determine Type of Change**
   - Is this a new documentation section or an update to existing one?
   - If uncertain — check existing structure in `@/ru/` and `@/en/` directories
   - Use Grep/Glob to search for similar sections if needed

5. **Create/Update Russian Version (ru/)**
   - ALWAYS start with the Russian version in the `ru/` directory
   - Follow the structure from README.ru.md:
     - Title `# Title` (mandatory first element)
     - Navigation (if section is large)
     - Divider `---` after navigation
     - Anchors `<a name="anchor"></a>` before subsections
     - First section should be named "Основы" (not "Начало", "Введение")
   - Code formatting:
     - Methods/classes in single backticks: `setLabel()`
     - Code blocks in triple backticks with language
     - Use-statements in Torchlight collapse
     - Specify filename for examples: ` ```php filename:config/moonshine.php `
   - Lists:
     - Items end with a comma
     - Last item ends with a period
   - All sentences end with a period
   - Use `**MoonShine**` with double asterisks

6. **Translate to English (en/)**
   - After completing the Russian version, create an English translation
   - Place in `@/en/` following the same path as in `@/ru/`
   - Synchronize line-by-line with the Russian version where possible
   - Preserve all formatting and structure

7. **Update Navigation (if new section)**
   - If this is a new section, add it to the `@/navigation.md` file
   - Check which section it logically belongs to

8. **Quality Check**
   - Are all code examples correct?
   - Are there screenshots (if needed)?
   - Do all links use the `{{version}}` placeholder?
   - Are RU and EN versions synchronized?

## Additional Guidelines

- Use alerts:
  - `> [!NOTE]` for simple notifications
  - `> [!WARNING]` for warnings
  - `> [!TIP]` for tips

- For images:
  - Path: `/resources/screenshots/`
  - URL: `https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/filename.png`
  - For dark/light theme: `#light` or `#dark`

- Use `@include()` for reusable parts from `_includes/`

- Version placeholder: `{{version}}` in links, for example:
  ```markdown
  [Select](/docs/{{version}}/fields/select)
  ```

## Before Starting Work

Use TodoWrite to plan the task considering all steps above.

## If Questions Arise

1. Check `.context/moonshine` to clarify implementation details
2. Use WebSearch to find additional information
3. Ask the user via AskUserQuestion

Start working!
