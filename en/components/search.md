# Search

@include('_includes/note-about-appearance-layout')

The `Search` component adds a search form to layout.

~~~tabs
tab: Class
```php
Search::make()
```
tab: Blade
```blade
<x-moonshine::layout.search
    placeholder="Search..."
/>
```
~~~

Modifiers are also available for both the input and the entire form.

```php
Search::make()
    ->modifyInput(
        fn(Text $input) => $input
    )
    ->modifyForm(fn(FormBuilder $form) => $form)
```

By default, in the standard layout, the `Search` component is located in the `Header` component, but it also fits well into the `Sidebar`.
To place the search form in the sidebar, you can use the [sidebarSlot()](/docs/{{version}}/appearance/layout#slots) method.

For more information about how the search works, see [ModelResource > Search](/docs/{{version}}/model-resource/search).
