# Head

- [Основы](#basics)
- [Заголовок страницы](#title)
- [Цвет темы](#theme)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `Head` предназначен для размещения информации о документе: метаданные (например, заголовок окна или кодировка), ссылки на скрипты и таблицы стилей.

> [!NOTE]
> Компонент `Head` содержит по умолчанию некоторые стандартные метаданные.

```php
make(array|iterable $components = [])
```

- `$components` - массив компонентов.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Head;

Head::make([
    Meta::make('csrf-token')->customAttributes([
        'content' => 'token',
    ]),
]);
```
tab: Blade
```blade
<x-moonshine::layout.head>
    <meta name="csrf-token" content="token" />
</x-moonshine::layout.head>
```
~~~

> [!NOTE]
> Родительский компонент: [Html](/docs/{{version}}/components/html). \
> Дочерние компоненты: [Meta](/docs/{{version}}/components/meta), [Assets](/docs/{{version}}/components/assets), [Favicon](/docs/{{version}}/components/favicon).

<a name="title"></a>
## Заголовок страницы

Для установки заголовка страницы можно воспользоваться методом `title()` или указать соответствующий параметр в Blade компоненте.

~~~tabs
tab: Class
```php
title(string $title);
```
```php
Head::make([
    // ...
])
    ->title('Page Title');
```
tab: Blade
```blade
<x-moonshine::layout.head title='Page Title'>
    // ...
</x-moonshine::layout.head>
```
~~~

<a name="theme"></a>
## Цвет темы

Некоторые браузеры позволяют предложить цвет темы, основанный на палитре вашего сайта.
При этом интерфейс браузера адаптируется к предложенному цвету.

Для добавления цвета необходимо воспользоваться методом `bodyColor()` или указать соответствующий параметр в Blade компоненте.

~~~tabs
tab: Class
```php
bodyColor(string $color);
```
```php
Head::make([
    // ...
])
    ->bodyColor('#7843e9')
```
tab: Blade
```blade
<x-moonshine::layout.head bodyColor='#7843e9'>
    // ...
</x-moonshine::layout.head>
```
~~~
