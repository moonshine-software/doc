# Box

- [Основы](#basics)
- [Заголовок](#heading)
- [Темный стиль](#dark)
- [Иконка](#icon)
---

<a name="basics"></a>
## Основы

Для выделения контента можно использовать компонент `Box`. Компонент идеально подходит чтобы выделить область.

```php
make(
Closure|string|iterable $labelOrComponents = [],
iterable $components = [],
)
```

- `$labelOrComponents` - содержит компоненты для отображения в блоке или текст для заголовка. Если первый параметр - строка, то это - заголовок,
- `$components` - содержит компоненты для отображения в блоке. Используется, если первым параметром указан заголовок, 

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Alert;

Box::make([
    Alert::make()->content('Text')
]);

```
tab: Blade
```blade
<x-moonshine::layout.box>
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~

<a name="heading"></a>
## Заголовок

Если нужно отобразить заголовок, то просто передайте его первым параметром, а вторым список компонентов

~~~tabs
tab: Class
```php
Box::make('Title box', ['Hello!']);
```
tab: Blade
```blade
<x-moonshine::box title="Title box">
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~

<a name="dark"></a>
## Темный стиль

Вы можете установить темный стиль для блока с помощью метода `dark()` в классе.

~~~tabs
tab: Class
```php
Box::make(['Hello!'])->dark();
```
tab: Blade
```blade
<x-moonshine::box dark>
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~

<a name="icon"></a>
## Иконка

Чтобы отобразить иконку в блоке, используется метод `icon`

~~~tabs
tab: Class
```php
Box::make('Title box', ['Hello!'])->icon('users');
```
tab: Blade
```blade
<x-moonshine::box title="Title box">
    <x-moonshine::icon name="users"></x-moonshine::icon>
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~
