# Notifications

@include('_includes/note-about-appearance-layout')

Компонент `Notifications` добавляет в шаблон элемент для вывода уведомлений в виде dropdown.

~~~tabs
tab: Class
```php
Notifications::make()
```
tab: Blade
```blade
<x-moonshine::layout.notifications/>
```
~~~

По умолчанию в стандартном шаблоне компонент `Notifications` расположен в компоненте `Header`, но также он хорошо вписывается в `Sidebar`.
Чтобы разместить `Notifications` в сайдбаре, можно воспользоваться методом [sidebarTopSlot()](/docs/{{version}}/appearance/layout#slots).

Подробнее об уведомлениях читайте в разделе [Уведомления](/docs/{{version}}/advanced/notifications).
