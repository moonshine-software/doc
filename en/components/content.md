# Content

@include('_includes/note-about-appearance-layout')

The `Content` component is designed for the area that displays the content part of the page.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Content;

Content::make([
    Title::make(
        $this->getPage()->getTitle()
    ),

    Components::make(
        $this->getPage()->getComponents()
    ),
])
```
tab: Blade
```blade
<x-moonshine::layout.content>
    <article class="article">
        Content
    </article>
</x-moonshine::layout.content>
```
~~~
