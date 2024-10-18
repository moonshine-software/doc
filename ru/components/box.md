# Box

- [Основы](#basics)
- [Заголовок](#heading)
- [Темный стиль](#dark)
- [Иконка](#icon)
---

<a name="basics"></a>
## Основы

Для выделения контента можно использовать компонент `moonshine::box`. Компонент оборачивает содержимое в div


```php
make( Closure|string|iterable $labelOrComponents = [],
        iterable $components = [],
        protected string $title = '',
        protected bool $dark = false);
```

- `$labelOrComponents` - содержит компоненты для отображения в блоке или текст для заголовка. Если первый параметр - строка, то это - заголовок,
- `$components` - содержит компоненты для отображения в блоке. Используется, если в есть заголовок, 
- `$title` - заголовок блока (опционально),
- `$dark` - это форсированный темный стиль, он будет темный даже если включена светлая тема.

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

Если нужно отобразить заголовок, то для этого используется параметр `title`

~~~tabs
tab: Class
```php
Box::make( ['Hello!'], title:'Title box');
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

Вы можете установить темный стиль для блока, указав параметр `dark` со значением `TRUE` или с помощью метода dark() в классе.

~~~tabs
tab: Class
```php
Box::make([['Hello!'])->dark();
```
tab: Blade
```blade
<x-moonshine::box :dark="true">
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~

<a name="icon"></a>
## Иконка

Чтобы отобразить иконку в блоке, используется параметр `icon`

~~~tabs
tab: Class
```php
Box::make( ['Hello!'], title:'Title box')->icon('users');
```
tab: Blade
```blade
<x-moonshine::box title="Title box">
    <x-moonshine::icon name="users"></x-moonshine::icon>
    {{ 'Hello!' }}
</x-moonshine::box>
```
~~~
