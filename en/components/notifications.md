# Notifications

@include('_includes/note-about-appearance-layout')

The `Notifications` component adds an element to layout for displaying notifications in the form of a dropdown.

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

By default, in the standard layout, the `Notifications` component is located in the `Header` component, but it also fits well into the `Sidebar`.
To place `Notifications` in the sidebar, you can use the [sidebar Top Slot()](/docs/{{version}}/appearance/layout#slots) method.

For more information about notifications, see the [Notifications](/docs/{{version}}/advanced/notifications) section.
