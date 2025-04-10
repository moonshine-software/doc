# Search

@include('_includes/note-about-appearance-layout')

Компонент `Search` добавляет в шаблон форму поиска.

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

По умолчанию в стандартном шаблоне компонент `Search` расположен в компоненте `Header`, но также он хорошо вписывается в `Sidebar`.
Чтобы разместить форму поиска в сайдбаре, можно воспользоваться методом [sidebarSlot()](/docs/{{version}}/appearance/layout#slots).

Подробнее о том, как работает поиск читайте в разделе [ModelResource > Поиск](/docs/{{version}}/model-resource/search).
