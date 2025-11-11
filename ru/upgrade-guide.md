---
title: Upgrade guide
---

# Руководство по обновлению MoonShine 3.x → 4.0

- [Автоматический апгрейд](#auto-upgrade)
- [Обновление зависимостей](#update-dependencies)
- [Изменения пространств имен](#namespace-changes)
- [Изменения в структуре ресурсов](#resource-changes)
- [Изменения в полях](#field-changes)
- [Изменения в Layout](#layout-changes)
- [Устаревшие классы и методы](#deprecated)
- [Асинхронные методы](#async-methods)

---

<a name="auto-upgrade"></a>
## Автоматический апгрейд

Для упрощения процесса миграции вы можете воспользоваться пакетом [warete/moonshine-upgrade](https://github.com/warete/moonshine-upgrade), который автоматически выполнит все необходимые изменения для перехода на MoonShine 4.0.

<a name="update-dependencies"></a>
## Обновление пакета

Измените версию пакета в composer.json и обновите зависимости.

```json
{
    "require": {
        "moonshine/moonshine": "^4.0"
    }
}
```

```shell
composer update
```

<a name="namespace-changes"></a>
## Изменения пространств имен

```php
use MoonShine\Laravel\Forms\FiltersForm; // [tl! remove]
use MoonShine\Crud\Forms\FiltersForm; // [tl! add]

use MoonShine\Laravel\Forms\LoginForm; // [tl! remove]
use MoonShine\Crud\Forms\LoginForm; // [tl! add]

use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse; // [tl! remove]
use MoonShine\Crud\JsonResponse; // [tl! add]

use MoonShine\Laravel\MoonShineRequest; // [tl! remove]
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract; // [tl! add]

use MoonShine\Laravel\Enums\Action; // [tl! remove]
use MoonShine\Support\Enums\Action; // [tl! add]

use MoonShine\Laravel\Enums\Ability; // [tl! remove]
use MoonShine\Support\Enums\Ability; // [tl! add]

use MoonShine\Laravel\Traits\WithComponentsPusher; // [tl! remove]
use MoonShine\Crud\Traits\WithComponentsPusher; // [tl! add]
```

<a name="resource-changes"></a>
## Изменения в структуре ресурсов

Многие методы и свойства перенесены из ресурсов в соответствующие CRUD-страницы.

Метод `rules()` перенесен из ресурса в `FormPage`.

Методы `metrics()`, `queryTags()`, `filters()` и т.д. перенесены в `IndexPage`.

Метод `indexButtons()` удален из ресурса, вместо него следует использовать метод `buttons()` в соответствующей индексной странице.

Это далеко не полный список изменений в ресурсе,
но процесс переноса всего соответствующего функционала из ресурса в CRUD-страницы довольно интуитивный и не должен составить труда.

<a name="field-changes"></a>
## Изменения в полях

Удалено поле `StackFields`, вместо него следует использовать поле `Fieldset`.

```php
StackFields::make('Title', [ // [tl! remove]
    Text::make('Field 1'), // [tl! remove]
    Text::make('Field 2'), // [tl! remove]
]) // [tl! remove]

Fieldset::make('Title', [ // [tl! add]
    Text::make('Field 1'), // [tl! add]
    Text::make('Field 2'), // [tl! add]
]) // [tl! add]
```

<a name="layout-changes"></a>
## Изменения в Layout

### Удален CompactLayout

Шаблон `CompactLayout` был удален. Если вы использовали этот шаблон, перейдите на расширение стандартного `AppLayout`.

```php
use MoonShine\Laravel\Layouts\CompactLayout; // [tl! remove]
use MoonShine\Laravel\Layouts\AppLayout; // [tl! add]
```

### Новые палитры

Введена система палитр для управления цветовой схемой. По умолчанию используется `PurplePalette`.

Подробнее о работе с палитрами смотрите в разделе [**Color Manager**](/docs/{{version}}/appearance/colors).

### Изменения в MenuItem

Параметры в методе `MenuItem::make()` поменялись местами, теперь первым идет `$filler`, затем `$label`.

Параметр `$label` стал необязательным, по умолчанию он берется из метода `getLabel()` наполнителя.

```php
MenuItem::make('Settings', SettingResource::class) // [tl! remove]
MenuItem::make(SettingResource::class) // [tl! add]
```

<a name="deprecated"></a>
## Устаревшие классы и методы

Следующие классы и методы объявлены устаревшими и будут удалены в версии 5.0.

### Устаревшие классы

| Класс                                                    | Замена                                                |
|----------------------------------------------------------|-------------------------------------------------------|
| `MoonShine\Laravel\Notifications\NotificationButton`     | `MoonShine\Crud\Notifications\NotificationButton`     |
| `MoonShine\Laravel\Http\Responses\MoonShineJsonResponse` | `MoonShine\Crud\JsonResponse`                         |
| `MoonShine\Laravel\MoonShineUI`                          | Вместо `MoonShineUI::toast()` теперь хелпер `toast()` |
| `MoonShine\Laravel\Handlers\Handlers`                    | `MoonShine\Crud\Handlers\BaseHandlers`                |
| `MoonShine\Laravel\Handlers\Handler`                     | `MoonShine\Crud\Handlers\BaseHandler`                 |

### Устаревшие методы в ModelResource

| Метод                | Замена                   |
|----------------------|--------------------------|
| `getIgnoredFields()` | Перенесено в `IndexPage` |
| `filters()`          | Перенесено в `IndexPage` |
| `hasFilters()`       | Перенесено в `IndexPage` |
| `queryTags()`        | Перенесено в `IndexPage` |
| `hasQueryTags()`     | Перенесено в `IndexPage` |
| `handlers()`         | Перенесено в `IndexPage` |
| `hasHandlers()`      | Перенесено в `IndexPage` |
| `getHandlers()`      | Перенесено в `IndexPage` |

### Устаревшие трейты

| Трейт          | Замена                |
|----------------|-----------------------|
| `HasFilters`   | Перенос в `IndexPage` |
| `HasQueryTags` | Перенос в `IndexPage` |
| `HasHandlers`  | Перенос в `IndexPage` |

> [!WARNING]
> Все перечисленные классы и методы будут полностью удалены в версии 5.0. Рекомендуется перейти на новые альтернативы.

<a name="async-methods"></a>
## Асинхронные методы

Всем асинхронным методам нужно добавить атрибут `#[AsyncMethod]`.

Асинхронные методы теперь поддерживают "DI".

```php
use MoonShine\Crud\JsonResponse;
use MoonShine\Support\Attributes\AsyncMethod;

class MyPage extends Page
{
    #[AsyncMethod]
    public function someAsyncMethod(JsonResponse $response): JsonResponse
    {
        return $response->toast('Loaded successfully');
    }
}
```
