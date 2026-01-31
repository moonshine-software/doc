#!/usr/bin/env python3
"""
Generate MoonShine documentation from PR using OpenAI API.
"""

import os
import sys
import base64
import time
from openai import OpenAI, APIError, RateLimitError, APIConnectionError
from pathlib import Path


def read_claude_md():
    """Read CLAUDE.md for documentation standards."""
    claude_md_path = Path(__file__).parent.parent.parent / "CLAUDE.md"
    if claude_md_path.exists():
        return claude_md_path.read_text()
    return ""


def read_navigation():
    """Read navigation.md for documentation structure."""
    nav_path = Path(__file__).parent.parent.parent / "navigation.md"
    if nav_path.exists():
        return nav_path.read_text()
    return ""


def list_existing_docs():
    """List existing documentation files to help identify update targets."""
    doc_root = Path(__file__).parent.parent.parent
    existing = []

    for lang in ['en', 'ru']:
        lang_dir = doc_root / lang
        if lang_dir.exists():
            for md_file in lang_dir.rglob('*.md'):
                relative = md_file.relative_to(doc_root)
                existing.append(str(relative))

    return sorted(existing)


def find_relevant_files(pr_diff: str, existing_files: list) -> dict:
    """Find and read content of files that might need updates based on PR diff."""
    doc_root = Path(__file__).parent.parent.parent
    relevant_content = {}

    # Keywords to file mapping
    keyword_mapping = {
        'command': ['en/advanced/commands.md', 'ru/advanced/commands.md'],
        'artisan': ['en/advanced/commands.md', 'ru/advanced/commands.md'],
        'install': ['en/advanced/commands.md', 'ru/advanced/commands.md'],
        'controller': ['en/advanced/controllers.md', 'ru/advanced/controllers.md'],
        'handler': ['en/advanced/handlers.md', 'ru/advanced/handlers.md'],
        'route': ['en/advanced/routes.md', 'ru/advanced/routes.md', 'en/model-resource/routes.md', 'ru/model-resource/routes.md'],
        'field': ['en/fields/basic-methods.md', 'ru/fields/basic-methods.md'],
        'component': ['en/components/index.md', 'ru/components/index.md'],
        'resource': ['en/model-resource/index.md', 'ru/model-resource/index.md'],
        'page': ['en/page/index.md', 'ru/page/index.md'],
        'menu': ['en/appearance/menu.md', 'ru/appearance/menu.md'],
        'layout': ['en/appearance/layout.md', 'ru/appearance/layout.md'],
    }

    pr_diff_lower = pr_diff.lower()
    files_to_read = set()

    # Find relevant files based on keywords in diff
    for keyword, files in keyword_mapping.items():
        if keyword in pr_diff_lower:
            for f in files:
                if f in existing_files:
                    files_to_read.add(f)

    # Read content of relevant files (limit to avoid token overflow)
    max_files = 4  # 2 EN + 2 RU typically
    for filepath in list(files_to_read)[:max_files]:
        full_path = doc_root / filepath
        if full_path.exists():
            content = full_path.read_text(encoding='utf-8')
            # Limit content size per file
            if len(content) > 15000:
                content = content[:15000] + "\n\n... [truncated]"
            relevant_content[filepath] = content

    return relevant_content


def generate_documentation(pr_url: str, pr_number: str, pr_title: str, pr_diff: str):
    """Generate documentation using OpenAI API."""

    api_key = os.environ.get("OPENAI_API_KEY")
    if not api_key:
        print("Error: OPENAI_API_KEY not found")
        sys.exit(1)

    client = OpenAI(
        api_key=api_key,
        timeout=300.0,  # 5 minutes timeout
        max_retries=2
    )

    claude_md = read_claude_md()
    navigation = read_navigation()
    existing_files = list_existing_docs()
    relevant_files = find_relevant_files(pr_diff, existing_files)

    # Build relevant files content section
    relevant_content_section = ""
    if relevant_files:
        relevant_content_section = "\n\n**CURRENT CONTENT OF RELEVANT FILES (you must preserve and extend this):**\n\n"
        for filepath, content in relevant_files.items():
            relevant_content_section += f"### FILE: {filepath}\n```markdown\n{content}\n```\n\n"

    prompt = f"""You are helping to generate documentation for MoonShine Laravel admin panel framework.

A PR has been merged in the main MoonShine repository. Analyze the changes and generate appropriate documentation.

**PR Information:**
- URL: {pr_url}
- Number: #{pr_number}
- Title: {pr_title}

**PR Diff:**
```
{pr_diff[:50000] if pr_diff else "Diff not available"}
```

**CRITICAL: Existing Documentation Structure**

Before creating NEW files, you MUST check if documentation already exists for the topic.
Here is the current navigation structure:

```
{navigation}
```
{relevant_content_section}
**Your Task:**
1. Analyze the changes in the PR
2. Determine what documentation needs to be added
3. Generate documentation in Markdown format following the project standards
4. Create BOTH English (en/) and Russian (ru/) versions
5. Follow all formatting rules from CLAUDE.md

**IMPORTANT OUTPUT RULES:**

Use ONE of these formats:

1. **For NEW files** (topic doesn't exist in navigation):
```
FILE: path/to/new-file.md
```markdown
[complete new file content]
```
```

2. **For ADDING to existing files** (topic exists, need to add sections):
```
APPEND: path/to/existing-file.md
```markdown
[ONLY the new sections to add - will be appended to the end of the file]
[Include navigation links update if adding new sections]
```
```

3. **For updating navigation links in existing file** (when adding sections):
```
NAV_UPDATE: path/to/existing-file.md
[List of new navigation items to add, e.g.:]
- [New Section](#new-section)
```

**Documentation Standards:**
{claude_md}

If no documentation is needed (e.g., internal refactoring, tests only), output:
NO_DOCS_NEEDED: [brief explanation why]

Generate the documentation now."""

    print("Calling OpenAI API to generate documentation...")
    print(f"PR: {pr_url}")

    # Retry logic for rate limits
    max_attempts = 3
    for attempt in range(max_attempts):
        try:
            response = client.chat.completions.create(
                model="gpt-4o",
                max_tokens=16000,
                temperature=0.3,
                messages=[{
                    "role": "user",
                    "content": prompt
                }]
            )

            response_text = response.choices[0].message.content

            # Log token usage
            if hasattr(response, 'usage') and response.usage:
                print(f"\nToken usage:")
                print(f"  Prompt: {response.usage.prompt_tokens}")
                print(f"  Completion: {response.usage.completion_tokens}")
                print(f"  Total: {response.usage.total_tokens}")

            print("\nOpenAI Response:")
            print("=" * 80)
            print(response_text)
            print("=" * 80)

            # Parse and save files
            parse_and_save_files(response_text)

            return response_text

        except RateLimitError as e:
            if attempt < max_attempts - 1:
                wait_time = (attempt + 1) * 10
                print(f"Rate limit hit. Waiting {wait_time}s before retry...")
                time.sleep(wait_time)
            else:
                print(f"Rate limit error after {max_attempts} attempts: {e}")
                sys.exit(1)

        except APIConnectionError as e:
            print(f"Connection error: {e}")
            sys.exit(1)

        except APIError as e:
            print(f"OpenAI API error: {e}")
            sys.exit(1)

        except Exception as e:
            print(f"Unexpected error: {e}")
            sys.exit(1)


def parse_and_save_files(response: str):
    """Parse OpenAI's response and save generated files."""

    if "NO_DOCS_NEEDED" in response:
        print("\nNo documentation needed for this PR.")
        # Create a marker file so PR creation knows there's nothing to commit
        marker_path = Path(".github/.no_docs_needed")
        marker_path.parent.mkdir(parents=True, exist_ok=True)
        marker_path.write_text("No documentation changes needed", encoding='utf-8')
        return

    lines = response.split('\n')
    current_file = None
    current_mode = None  # 'file', 'append', or 'nav_update'
    current_content = []
    in_code_block = False
    nav_updates = {}  # filepath -> list of nav items

    for line in lines:
        # Detect operation type and file path
        file_match = None
        mode = None

        # Check for APPEND: format
        if line.startswith('APPEND: ') or line.startswith('### APPEND: '):
            file_match = line.replace('### APPEND: ', '').replace('APPEND: ', '').strip()
            mode = 'append'
        # Check for NAV_UPDATE: format
        elif line.startswith('NAV_UPDATE: ') or line.startswith('### NAV_UPDATE: '):
            file_match = line.replace('### NAV_UPDATE: ', '').replace('NAV_UPDATE: ', '').strip()
            mode = 'nav_update'
        # Check for FILE: formats
        elif line.startswith('FILE: ') or line.startswith('### FILE: '):
            file_match = line.replace('### FILE: ', '').replace('FILE: ', '').strip()
            mode = 'file'
        elif line.startswith('**FILE:'):
            file_match = line.replace('**FILE:', '').replace('**', '').strip()
            mode = 'file'

        if file_match:
            # Save previous file if any
            if current_file and current_content:
                if current_mode == 'append':
                    append_to_file(current_file, '\n'.join(current_content))
                elif current_mode == 'nav_update':
                    nav_updates[current_file] = current_content
                else:
                    save_file(current_file, '\n'.join(current_content))

            # Start new file
            current_file = file_match
            current_mode = mode
            current_content = []
            in_code_block = False

        elif current_file:
            # Check for code block markers
            if line.strip().startswith('```'):
                in_code_block = not in_code_block
                continue

            # Collect content
            if current_mode == 'nav_update':
                # For nav_update, collect lines starting with -
                if line.strip().startswith('- '):
                    current_content.append(line.strip())
            elif in_code_block:
                current_content.append(line)

    # Save last file
    if current_file and current_content:
        if current_mode == 'append':
            append_to_file(current_file, '\n'.join(current_content))
        elif current_mode == 'nav_update':
            nav_updates[current_file] = current_content
        else:
            save_file(current_file, '\n'.join(current_content))

    # Process navigation updates
    for filepath, nav_items in nav_updates.items():
        update_navigation(filepath, nav_items)


def append_to_file(filepath: str, content: str):
    """Append content to an existing file."""
    doc_root = Path(__file__).parent.parent.parent

    # Security: Ensure path is relative and safe
    filepath = filepath.lstrip('/')
    full_path = doc_root / filepath

    # Security checks
    try:
        resolved_path = full_path.resolve()
        relative_path = resolved_path.relative_to(doc_root.resolve())
    except (ValueError, RuntimeError):
        print(f"\n✗ SECURITY: Rejected path traversal attempt: {filepath}")
        return

    if not full_path.exists():
        print(f"\n✗ Cannot append to non-existent file: {filepath}")
        return

    # Read existing content and append
    existing = full_path.read_text(encoding='utf-8')
    new_content = existing.rstrip() + '\n\n' + content.strip() + '\n'

    full_path.write_text(new_content, encoding='utf-8')
    print(f"\n✓ Appended to: {filepath}")


def update_navigation(filepath: str, nav_items: list):
    """Update navigation section in a file by adding new items."""
    doc_root = Path(__file__).parent.parent.parent

    filepath = filepath.lstrip('/')
    full_path = doc_root / filepath

    if not full_path.exists():
        print(f"\n✗ Cannot update navigation in non-existent file: {filepath}")
        return

    content = full_path.read_text(encoding='utf-8')
    lines = content.split('\n')

    # Find the navigation section (lines starting with - [ before the first ---)
    nav_end_idx = None
    for i, line in enumerate(lines):
        if line.strip() == '---':
            nav_end_idx = i
            break

    if nav_end_idx is None:
        print(f"\n⚠ No navigation section found in: {filepath}")
        return

    # Insert new nav items before ---
    for nav_item in reversed(nav_items):
        lines.insert(nav_end_idx, nav_item)

    new_content = '\n'.join(lines)
    full_path.write_text(new_content, encoding='utf-8')
    print(f"\n✓ Updated navigation in: {filepath}")


def save_file(filepath: str, content: str):
    """Save generated content to file."""

    # Security: Ensure path is relative and safe
    filepath = filepath.lstrip('/')

    # Convert to Path object
    full_path = Path(filepath)

    # Security: Prevent path traversal attacks
    try:
        # Resolve to absolute path and check it's within current directory
        resolved_path = full_path.resolve()
        current_dir = Path.cwd().resolve()

        # Check if resolved path is within current directory
        relative_path = resolved_path.relative_to(current_dir)
    except (ValueError, RuntimeError):
        print(f"\n✗ SECURITY: Rejected path traversal attempt: {filepath}")
        return

    # Security: Only allow markdown files in en/ and ru/ directories, plus navigation.md
    allowed_extensions = {'.md'}
    allowed_prefixes = ('en/', 'ru/')
    allowed_root_files = ('navigation.md',)

    if full_path.suffix not in allowed_extensions:
        print(f"\n✗ SECURITY: Rejected non-markdown file: {filepath}")
        return

    # Check if file is in allowed directories or is an allowed root file
    # Use the normalized relative path from resolve() for consistency
    normalized_path = str(relative_path).replace('\\', '/')  # Normalize Windows paths
    is_in_allowed_dir = any(normalized_path.startswith(prefix) for prefix in allowed_prefixes)
    is_allowed_root_file = normalized_path in allowed_root_files

    if not (is_in_allowed_dir or is_allowed_root_file):
        print(f"\n✗ SECURITY: Rejected file outside allowed locations: {filepath}")
        print(f"  Normalized path: {normalized_path}")
        return

    # Security: Limit file size to prevent disk exhaustion
    max_size = 1024 * 1024  # 1MB
    if len(content) > max_size:
        print(f"\n✗ SECURITY: File too large ({len(content)} bytes): {filepath}")
        return

    # Security: Check for potentially dangerous content
    dangerous_patterns = [
        '<?php',
        '#!/bin/',
        '<script',
        'eval(',
        'exec(',
        '__import__',
    ]
    content_lower = content.lower()
    for pattern in dangerous_patterns:
        if pattern.lower() in content_lower:
            print(f"\n⚠ WARNING: Potentially dangerous content detected in: {filepath}")
            # Still allow but warn - it's documentation, might have code examples
            break

    # Create parent directories
    full_path.parent.mkdir(parents=True, exist_ok=True)

    # Write file
    full_path.write_text(content.strip() + '\n', encoding='utf-8')

    print(f"\n✓ Created/updated: {filepath}")


def main():
    pr_url = os.environ.get("PR_URL", "")
    pr_number = os.environ.get("PR_NUMBER", "")
    pr_title = os.environ.get("PR_TITLE", "")
    pr_diff_b64 = os.environ.get("PR_DIFF", "")

    # Security: Validate PR URL
    if not pr_url:
        print("Error: PR_URL environment variable not set")
        sys.exit(1)

    # Security: Ensure PR URL is from GitHub and moonshine-software org
    allowed_domains = [
        "https://github.com/moonshine-software/",
        "https://api.github.com/repos/moonshine-software/",
    ]
    if not any(pr_url.startswith(domain) for domain in allowed_domains):
        print(f"Error: Invalid PR URL domain: {pr_url}")
        print(f"Only moonshine-software GitHub URLs are allowed")
        sys.exit(1)

    # Security: Validate PR number is numeric
    if pr_number and not pr_number.isdigit():
        print(f"Error: Invalid PR number: {pr_number}")
        sys.exit(1)

    # Security: Limit PR title length
    if len(pr_title) > 500:
        print("Warning: PR title too long, truncating")
        pr_title = pr_title[:500]

    # Decode base64 diff if present
    pr_diff = ""
    if pr_diff_b64:
        try:
            # Security: Limit decoded diff size
            max_diff_size = 10 * 1024 * 1024  # 10MB
            if len(pr_diff_b64) > max_diff_size * 4 / 3:  # base64 is ~33% larger
                print("Warning: PR diff too large, truncating")
                pr_diff_b64 = pr_diff_b64[:int(max_diff_size * 4 / 3)]

            pr_diff = base64.b64decode(pr_diff_b64).decode('utf-8')
        except Exception as e:
            print(f"Warning: Could not decode PR diff: {e}")
            pr_diff = ""

    generate_documentation(pr_url, pr_number, pr_title, pr_diff)
    print("\n✓ Documentation generation complete!")


if __name__ == "__main__":
    main()
