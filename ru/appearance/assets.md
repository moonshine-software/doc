---
video: [Основы](https://youtu.be/95qxienFmtI?si=umF9mxBMftHenk5B&t=512),[Собственная сборка](https://youtu.be/Egoi6wA3ZVE?si=Er3hme2MOHWF8uSd)
---

# Assets

- [Основы](#basics)
- [Типы ресурсов](#asset-types)
- [Коллекции ресурсов](#asset-collections)
- [Модификация ресурсов](#asset-modification)
- [Версионирование](#versioning)
- [Добавление ресурсов](#how-to-add)
    - [Глобально](#global)
    - [Шаблон](#layout)
    - [CrudResource](#resource)
    - [Page](#page)
    - [Component](#component)
    - [Field](#field)
- [Вывод через Blade](#blade)
- [Собственная сборка](#custom-build)

---

<a name="basics"></a>
## Основы

***AssetManager*** в **MoonShine** предоставляет удобный способ управления *CSS* и *JavaScript* ресурсами вашей административной панели.
Он поддерживает различные типы ресурсов, включая внешние файлы, встроенный код и версионирование.

<a name="asset-types"></a>
## Типы ресурсов

В **MoonShine** есть несколько типов ресурсов:

- `MoonShine\AssetManager\Js` - js через тег `<script src>`,
- `MoonShine\AssetManager\Css` - css через тег `<link>`,
- `MoonShine\AssetManager\InlineCss` - css через тег `<style>`,
- `MoonShine\AssetManager\InlineJs` - js через тег `<script>`,
- `MoonShine\AssetManager\Raw` - произвольный контент в `head`.

### JavaScript файлы

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Базовое подключение
Js::make('/js/app.js');

// С отложенной загрузкой
Js::make('/js/app.js')->defer();

// С атрибутами
Js::make('/js/app.js')->customAttributes([
    'data-module' => 'main'
]);
```

### CSS файлы

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Css;

// Базовое подключение
Css::make('/css/styles.css');

// С отложенной загрузкой
Css::make('/css/styles.css')->defer();

// С атрибутами
Css::make('/css/styles.css')->customAttributes([
    'media' => 'print'
]);
```

### Встроенный JavaScript

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\InlineJs;

InlineJs::make(<<<'JS'
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Loaded");
    });
JS);
```

### Встроенный CSS

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\InlineCss;

InlineCss::make(<<<'CSS'
    .custom-class {
        color: red;
    }
CSS);
```

### Raw-контент

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Raw;

Raw::make('<link rel="preconnect" href="https://fonts.googleapis.com">');
```

<a name="asset-collections"></a>
## Коллекции ресурсов

***AssetManager*** позволяет управлять порядком загрузки ресурсов.
Мы рекомендуем использовать DI, чтобы начать взаимодействие с ***AssetManager***, за сервис отвечает интерфейс `MoonShine\Contracts\AssetManager\AssetManagerContract`.
Также **MoonShine** предоставляет удобные методы взаимодействия с ***AssetManager*** в разных сущностях, таких как `CrudResource`, `Page`, `Layout`, `Component` и `Field`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Добавить ресурсы в конец
$assetManager->append([
    Js::make('/js/last.js')
]);

// Добавить ресурсы в начало
$assetManager->prepend([
    Js::make('/js/first.js')
]);

// Добавить ресурсы в порядке добавления
$assetManager->add([
    Js::make('/js/middle.js')
]);
```

Метод `append()` всегда будет добавлять ресурсы до основного списка из `CrudResource`, `Page`, `Layout`, `Component`, `Field`, а `prepend()` после.
Метод `add()` будет зависеть от жизненного цикла приложения. Допустим, вы добавляете ассеты в `ModelResource`,
но перед отображением страницы будет вызван `Layout`, который также в свою очередь добавит ассеты, тем самым ассеты `Layout` добавятся в конце.

> [!TIP]
> Вы также можете воспользоваться хелпером `moonshine()->getAssetManager()`

<a name="asset-modification"></a>
## Модификация ресурсов

Вы можете модифицировать коллекцию ресурсов с помощью замыканий:

```php
$assetManager->modifyAssets(function($assets) {
    // Модифицируем коллекцию ресурсов
    return array_filter($assets, function($asset) {
        return !str_contains($asset->getLink(), 'remove-this');
    });
});
```

<a name="versioning"></a>
## Версионирование

***AssetManager*** поддерживает версионирование ресурсов для управления кешированием,
по умолчанию будет использоваться версия **MoonShine**, но вы можете переопределить у конкретного ресурса:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Добавление версии к отдельному ресурсу
Js::make('/js/app.js')->version('1.0.0');

// Результат: /js/app.js?v=1.0.0
```

Версионирование автоматически добавляет параметр `v` к URL ресурса. Если URL уже содержит параметры запроса, версия будет добавлена через `&`.

<a name="how-to-add"></a>
## Добавление ресурсов

<a name="global"></a>
### Глобально

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// MoonShineServiceProvider
// [tl! collapse:4]
use MoonShine\AssetManager\Js;
use MoonShine\Contracts\AssetManager\AssetManagerContract;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;

public function boot(
    CoreContract $core,
    ConfiguratorContract $config,
    AssetManagerContract $assets,
): void
{
    $assets->add(Js::make('/js/app.js'));
}
```

<a name="layout"></a>
### Шаблон

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Js;

final class MoonShineLayout extends CompactLayout
{
    protected function assets(): array
    {
        return [
            Js::make(Vite::asset('resources/js/app.js'))
        ];
    }
}
```

<a name="resource"></a>
### CrudResource

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\InlineJs;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    $this->getAssetManager()
        ->prepend(InlineJs::make('alert(1)'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="page"></a>
### Page

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    parent::onLoad();

    $this->getAssetManager()
        ->add(Css::make('/css/app.css'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="component"></a>
### Component

#### На лету

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Layout\Box;

Box::make()->addAssets([
    Js::make('/js/custom.js'),
    Css::make('/css/styles.css')
]);
```

#### При создании компонента

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\MoonShineComponent;

final class MyComponent extends MoonShineComponent
{
    /**
     * @return list<AssetElementContract>
     */
    protected function assets(): array
    {
        return [
            Js::make('/js/custom.js'),
            Css::make('/css/styles.css')
        ];
    }
}
```

#### При создании компонента через AssetManager

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\MoonShineComponent;

final class MyComponent extends MoonShineComponent
{
    protected function booted(): void
    {
        parent::booted();

        $this->getAssetManager()
          ->add(Css::make('/css/app.css'))
          ->append(Js::make('/js/app.js'));
    }
}
```

<a name="field"></a>
### Field

То же самое как и у `Component`, так как `Field` является компонентом.

<a name="blade"></a>
## Вывод через Blade

### Основная тема

```blade
<x-moonshine::layout.assets>
    @vite([
        'resources/css/main.css',
        'resources/js/app.js',
    ], 'vendor/moonshine')
</x-moonshine::layout.assets>
```

### Компактная тема

```blade
<x-moonshine::layout.assets>
    @vite([
        'resources/css/main.css',
        'resources/css/minimalistic.css',
        'resources/js/app.js',
    ], 'vendor/moonshine')
</x-moonshine::layout.assets>
```

<a name="custom-build"></a>
## Собственная сборка

В процессе работы с **MoonShine**, особенно при использовании подхода через *Blade*, вам могут потребоваться дополнительные CSS-классы *TailwindCSS*, которых нет в изначальной сборке **MoonShine**. Для решения этой задачи подойдет собственная сборка, в которой будет включен **MoonShine**, и вы сможете собирать билды со своим набором классов и стилей + **MoonShine**.

### Автоматическая публикация

Для автоматической публикации собственной сборки выполните команду:

```shell
php artisan moonshine:publish
```

Выберите `Assets Template`.

После чего будут опубликованы и заменены следующие файлы:

- `vite.config.js`,
- `postcss.config.js`,
- `resources/css/app.css`.

> [!WARNING]
> Для автоматической публикации ассетов необходим *TailwindCSS* 4+ и *Laravel* 12+.

Вам останется только добавить ассеты в ваш проект.

### Реализация через MoonShineLayout

Необходимо добавить JavaScript **MoonShine** `$this->getMainThemeJs()`, а также ассеты вашего приложения, где `Css::make(Vite::asset('resources/css/app.css'))` также содержит CSS **MoonShine**.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            $this->getMainThemeJs(),
            Css::make(Vite::asset('resources/css/app.css')),
            Js::make(Vite::asset('resources/js/app.js')),
        ];
    }
}
```

### Реализация через Blade

Необходимо добавить JavaScript **MoonShine** `@vite(['resources/js/app.js'], 'vendor/moonshine')`, а также ассеты вашего приложения, где `resources/css/app.css` также содержит CSS **MoonShine**.

```blade
<x-moonshine::layout.head>
    <x-moonshine::layout.assets>
        @vite(['resources/js/app.js'], 'vendor/moonshine')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-moonshine::layout.assets>
</x-moonshine::layout.head>
```

### Ручная реализация собственной сборки

#### vite.config.js

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@moonshine-resources': '/vendor/moonshine/moonshine/src/UI/resources',
        }
    },
});
```

Удален плагин `tailwindcss()`:

```js
plugins: [
    laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
    }),
    tailwindcss() // [tl! remove]
]
```

Добавлен алиас для путей, где находятся ресурсы **MoonShine**:

```js
resolve: {
    alias: {
        '@moonshine-resources': '/vendor/moonshine/moonshine/src/UI/resources',
    }
}
```

#### postcss.config.js

Необходимо установить `@tailwindcss/postcss` и опубликовать `postcss.config.js` со следующим содержимым:

```js
export default {
  plugins: {
    '@tailwindcss/postcss': {},
  },
};
```

#### resources/css/app.css

Добавьте импорт CSS **MoonShine**:

```css
@import '../../vendor/moonshine/moonshine/src/UI/resources/css/main.css';

@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';
```
