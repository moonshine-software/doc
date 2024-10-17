# Box

- [Основы](#basics)
- [Заголовок](#heading)
- [Темный стиль](#dark)
- [Иконка](#icon)
---

<a name="basics"></a>
## Основы

Для выделения контента можно использовать компонент `moonshine::box`. Компонент оборачивает содержимое в div
~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Box;

Box::make( Closure|string|iterable $labelOrComponents = [],
        iterable $components = [],
        protected string $title = '',
        protected bool $dark = false);
```
tab: Blade
```blade
<x-moonshine::layout.box :dark="boolean" :title="string">
    {{ fake()->text() }}
</x-moonshine::box>
```
~~~

- `$labelOrComponents` - содержит компоненты для отображения в блоке или текст для заголовка. Если первый параметр - строка, то это - заголовок.
- `$components` - содержит компоненты для отображения в блоке. Используется, если есть заголовок 
- `$title` - заголовок блока.
- `$dark` - темный стиль.

~~~tabs
tab: Class
```php
Box::make(fake()->text());
# или
Box::make('Title box', fake()->text());
# или
Box::make('Title box', [fake()->text(), fake()->text()]);
```
tab: Blade
```blade
<x-moonshine::layout.box>
    {{ fake()->text() }}
</x-moonshine::box>
```
~~~

<a name="heading"></a>
## Заголовок

Если нужно отобразить заголовок, то для этого используется параметр `title`

~~~tabs
tab: Class
```php
Box::make( [fake()->text()], title:'Title box');
```
tab: Blade
```blade
<x-moonshine::box title="Title box">
    {{ fake()->text() }}
</x-moonshine::box>
```
~~~

<a name="dark"></a>
## Темный стиль

Вы можете установить темный стиль для блока, указав параметр `dark` со значением `TRUE` или с помощью метода dark() в классе.

~~~tabs
tab: Class
```php
Box::make(fake()->text())->dark();
```
tab: Blade
```blade
<x-moonshine::box :dark="true">
    {{ fake()->text() }}
</x-moonshine::box>
```
~~~

<a name="icon"></a>
## Иконка

Чтобы отобразить иконку в блоке, используется параметр `icon`

~~~tabs
tab: Class
```php
Box::make( [fake()->text()], title:'Title box')->icon('users';
```
tab: Blade
```blade
<x-moonshine::box title="Title box">
    <x-moonshine::icon name="users"></x-moonshine::icon>
    {{ fake()->text() }}
</x-moonshine::box>
```
~~~
