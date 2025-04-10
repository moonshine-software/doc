# Logo

- [Основы](#basics)
- [Атрибуты](#attributes)
- [Тёмная тема](#darkmode)

---

<a name="basics"></a>
## Основы

Компонент `Logo` отображает логотип вашей админ-панели.

```php
make(
    string $href,
    string $logo,
    ?string $logoSmall = null,
    ?string $title = null,
    bool $minimized = false,
)
```

 - `$href` - адрес ссылки для перехода по клику на логотип,
 - `$logo` - ссылка на изображения логотипа,
 - `$logoSmall` - ссылка на уменьшенную версию логотипа,
 - `$title` - подсказа при наведении,
 - `$minimized` - взаимодействует с [Sidebar](/docs/{{version}}/components/sidebar). Если установлено true, то автоматически будет выбрано small logo.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Logo;

Logo::make(
    '/admin',
    '/vendor/moonshine/logo.svg',
    '/vendor/moonshine/logo-small.svg'
),
```
tab: Blade
```blade
<x-moonshine::layout.logo
    :href="'/admin'"
    :logo="'/vendor/moonshine/logo.svg'"
    :logoSmall="'/vendor/moonshine/logo-small.svg'"
/>
```
~~~

<a name="attributes"></a>
## Атрибуты

Для добавления атрибутов к тегу `img` у лого существуют два метода для двух режимов отображения - `logoAttributes()` и `logoSmallAttributes()`.

```php
logoAttributes(array $attributes)

logoSmallAttributes(array $attributes)
```

<a name="darkmode"></a>
## Тёмная тема

Вы можете отдельно указать логотипы для тёмной темы.
Для этого воспользуйтесь методом `darkMode()`.

```php
darkMode(string $logo, ?string $small = null)
```

```php
protected function getLogoComponent(): Logo
{
    return parent::getLogoComponent()
        ->darkMode(
            asset('logo-dark.svg'),
            asset('logo-dark-small.svg'),
        );
}
```
