---
name: doc-pr
description: Generate documentation by PR link or PR ID
argument-hint: [pr link or pr id]
disable-model-invocation: true
allowed-tools: WebFetch, WebSearch, Bash(gh pr view:*), Bash(gh pr diff:*), Bash(git checkout:*), Bash(git -C .context/moonshine pull:*)
---

User provided Pull Request URL or ID: $ARGUMENTS

## MoonShine Codebase Context

!`git -C .context/moonshine pull 2>/dev/null`

Your task: analyze the PR and create/update MoonShine documentation.

## Critical Rules

> [!WARNING]
> **DO NOT FABRICATE!** If you are uncertain about something or lack information:
> 1. Search for information in `.context/moonshine` (MoonShine codebase)
> 2. Use WebSearch/WebFetch to find current information
> 3. Ask the user via AskUserQuestion

## Step-by-Step Plan

1. **Retrieve PR Information**
   - Use `gh pr view $ARGUMENTS` to get PR details
   - Study changes in the PR via `gh pr diff $ARGUMENTS`
   - Understand the context: is it a new feature, enhancement, or fix?

2. **Create Git Branch**
   - Based on the PR content, determine the section name (e.g., "rating-component", "new-field-type", etc.)
   - Create a new git branch with a descriptive name: `git checkout -b docs/section-name`
   - Use kebab-case for branch naming
   - Branch name should reflect the documentation section being created/updated

3. **Study Documentation Formatting Rules**
   - Read the file [references/formatting-rules.md](references/formatting-rules.md)
   - This is a mandatory file with formatting and structure rules
   - Follow all rules from there

4. **Determine Type of Change**
   - Is this a new documentation section or an update to existing one?
   - If uncertain — check existing structure in `ru/` and `en/` directories
   - Use Grep/Glob to search for similar sections if needed

5. **Create/Update Russian Version (ru/)**
   - ALWAYS start with the Russian version in the `ru/` directory
   - Follow the structure from references/formatting-rules.md

6. **Translate to English (en/)**
   - After completing the Russian version, create an English translation
   - Place in `en/` following the same path as in `ru/`
   - Synchronize line-by-line with the Russian version where possible
   - Preserve all formatting and structure

7. **Update Navigation (if new section)**
   - If this is a new section, add it to the `navigation.md` file
   - Check which section it logically belongs to

8. **Quality Check**
   - Are all code examples correct?
   - Are there screenshots (if needed)?
   - Do all links use the `{{version}}` placeholder?
   - Are RU and EN versions synchronized?

## If Questions Arise

1. Check `.context/moonshine` to clarify implementation details
2. Use WebSearch to find additional information
3. Ask the user via AskUserQuestion

Start working!
