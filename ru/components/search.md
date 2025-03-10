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

Подробнее о том, как работает поиск читайте в разделе [ModelResource > Поиск](/docs/{{version}}/model-resource/search).
