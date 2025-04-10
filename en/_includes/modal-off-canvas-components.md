> [!NOTE]
> The `content` parameter refers to the textual content of %s. It's suitable for displaying simple information (strings, HTML, etc.).
> However, if you want to embed components into %s — such as fields or forms that respond to value changes or rely on reactivity —
> it’s important to understand that MoonShine won’t be able to “see” components passed as plain strings.
> This limits functionality.
> **To ensure MoonShine properly handles fields inside %s, you should pass them using the `components` parameter.**

> [!TIP]
> If you're building the content of %s entirely with MoonShine components (fields, forms, etc.), use the `components` parameter instead of `content`.
