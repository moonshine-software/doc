# Content

@include('_includes/note-about-appearance-layout')

Компонент `Content` предназначен для отображения контентной части страницы.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

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
