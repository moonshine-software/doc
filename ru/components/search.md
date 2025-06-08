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
<x-moonshine-laravel::layout.search :action="'/'" :enabled="true" placeholder="Search..." />
```
~~~

Вам также доступны модификаторы для инпута и всей формы.

```php
Search::make()
    ->modifyInput(
        fn(Text $input) => $input
    )
    ->modifyForm(fn(FormBuilder $form) => $form)
```

По умолчанию в стандартном шаблоне компонент `Search` расположен в компоненте `Header`, но также он хорошо вписывается в `Sidebar`.
Чтобы разместить форму поиска в сайдбаре, можно воспользоваться методом [sidebarSlot()](/docs/{{version}}/appearance/layout#slots).

Подробнее о том, как работает поиск читайте в разделе [ModelResource > Поиск](/docs/{{version}}/model-resource/search).
