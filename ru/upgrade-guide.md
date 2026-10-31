---
title: Upgrade guide
---

# Руководство по обновлению

- [Обновление до 5.0 с 4.x](#upgrade-5-0)

<a name="high-impact-changes"></a>
## Изменения с высоким влиянием

- [Обновление зависимостей](#update-dependencies)
- [Фильтры, теги запросов и обработчики](#index-page)
- [Экранирование отображаемого текста](#display-escaping)

<a name="medium-impact-changes"></a>
## Изменения со средним влиянием

- [Удаленные классы](#removed-classes)
- [Импорт и экспорт](#import-export)
- [Переопределенные представления](#views)

<a name="low-impact-changes"></a>
## Изменения с низким влиянием

- [Значения конфигурации](#config-values)
- [Экранирование значений полей](#value-escaping)
- [Расширения файлов](#file-extensions)
- [URL ссылок](#link-urls)
- [Скелетон и спиннер таблиц](#tables)
- [Редактирование в popover](#popover)
- [Обертка запроса](#request)
- [Выпадающие меню](#dropdowns)
- [Контракты](#contracts)

---

<a name="upgrade-5-0"></a>
## Обновление до 5.0 с 4.x

#### Примерное время обновления: 30 минут

Мы стараемся описать все возможные изменения, нарушающие обратную совместимость.
Часть из них затрагивает редко используемые возможности **MoonShine**, поэтому на ваше приложение может повлиять лишь некоторая их доля.

> [!NOTE]
> Руководство дополняется и будет расширено до выхода версии 5.0.
> Для обновления с 3.x сначала выполните [руководство по обновлению 4.x](/docs/4.x/upgrade-guide).

<a name="update-dependencies"></a>
### Обновление зависимостей

**Вероятность влияния: высокая**

Для **MoonShine** 5.0 требуются PHP 8.4 или новее и Laravel 11, 12 или 13.
Laravel 10 больше не поддерживается.

Обновите следующие зависимости в `composer.json` вашего приложения:

- `moonshine/moonshine` до `^5.0`,
- `moonshine/import-export` до `^3.0`, если вы используете [импорт и экспорт](#import-export).

```shell
composer update
```

Для **MoonShine** 5.0 требуются `symfony/http-foundation` и `symfony/psr-http-message-bridge` версии 7.4 или 8.1.
Если Composer не может их установить из-за зафиксированных старых версий, обновите пакет вместе с зависимостями:

```shell
composer update moonshine/moonshine -W
```

<a name="resources"></a>
### Ресурсы

<a name="index-page"></a>
#### Фильтры, теги запросов и обработчики

**Вероятность влияния: высокая**

Трейты `HasFilters`, `HasQueryTags` и `HasHandlers` удалены из `ModelResource`.
Фильтры, теги запросов и обработчики настраиваются только в `IndexPage`.

Перенесите следующие методы из ресурса на его индексную страницу:

- `filters()`,
- `queryTags()`,
- `handlers()`,
- `getIgnoredFields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Resources\Post\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    protected function filters(): iterable
    {
        return [
            Text::make('Title', 'title'),
        ];
    }

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                'Published',
                static fn ($query) => $query->where('is_published', true)
            ),
        ];
    }
}
```

Методы ресурса `hasFilters()`, `getFilters()`, `hasQueryTags()`, `getQueryTags()`, `hasHandlers()` и `getHandlers()` также удалены.
Вызывайте их у индексной страницы.

```php
$resource->getFilters(); // [tl! remove]
$resource->getIndexPage()?->getFilters(); // [tl! add]
```

Значения фильтров и сохраненное состояние запроса по-прежнему читаются из ресурса, например через `getFilterParams()`.

Подробнее в разделах [Фильтры](/docs/{{version}}/model-resource/filters), [Теги запросов](/docs/{{version}}/model-resource/query-tags) и [Обработчики](/docs/{{version}}/advanced/handlers).

<a name="import-export"></a>
#### Импорт и экспорт

**Вероятность влияния: средняя**

**MoonShine** 5.0 работает с `moonshine/import-export` 3.x.

Трейт `ImportExportConcern` и интерфейс `HasImportExportContract` остаются в ресурсе вместе с полями импорта и экспорта.
Кнопки теперь являются обработчиками индексной страницы, поэтому добавьте в нее трейт `ImportExportHandlersConcern`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources\Category\Pages;

use MoonShine\ImportExport\Traits\ImportExportHandlersConcern;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class CategoryIndexPage extends IndexPage
{
    use ImportExportHandlersConcern;
}
```

Перенесите переопределения методов `import()`, `export()`, `isExportToCsv()` и `handlers()` из ресурса на индексную страницу.
Внутри страницы ресурс доступен через `getResource()`.

<a name="escaping"></a>
### Экранирование

<a name="display-escaping"></a>
#### Экранирование отображаемого текста

**Вероятность влияния: высокая**

Метки, подсказки, префиксы, суффиксы и строки, возвращаемые callback-функциями полей `beforeRender()` и `afterRender()`, теперь экранируются по умолчанию.
Метка вида `<strong>Name</strong>` отображается как текст.

Добавьте соответствующий метод `unescape…()` там, где нужен HTML.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel() // [tl! add]
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint(); // [tl! add]
```

Значения по умолчанию можно изменить в секции `escapes` конфигурации.

```php filename:config/moonshine.php
'escapes' => [
    'label' => true,
    'hint' => true,
    'prefix' => true,
    'suffix' => true,
    'before_render' => true,
    'after_render' => true,
],
```

Названия ссылок полей, метки связанных записей и заголовки модальных окон экранируются независимо от этих настроек.
Чтобы разрешить в них HTML, используйте `unescapeLinkName()`, `unescapeOptionLabels()` и `unescapeTitle()`.

Значения, реализующие `Illuminate\Contracts\Support\Htmlable`, например `HtmlString`, выводятся как подготовленный HTML.

> [!WARNING]
> Разрешайте HTML только для доверенного содержимого. Отключение экранирования не очищает строку.

Все настройки описаны в разделе [Экранирование отображаемого текста](/docs/{{version}}/security/display-escaping).

<a name="value-escaping"></a>
#### Экранирование значений полей

**Вероятность влияния: низкая**

Значения полей `Text`, `Textarea` и `BelongsTo` по-прежнему экранируются по умолчанию.
Новые настройки `escapes.value` и `escapes.value_on_apply` меняют это поведение глобально, поэтому, если оставить их включенными, ничего менять не нужно.

```php filename:config/moonshine.php
'escapes' => [
    // ...
    'value' => true,
    'value_on_apply' => true,
],
```

Если ваше поле использует трейт `WithEscapedValue` и переобъявляет свойство `$unescape`, измените его тип на `?bool`.
`null` означает, что поле следует глобальной настройке.

```php
protected bool $unescape = false; // [tl! remove]
protected ?bool $unescape = null; // [tl! add]
```

Вызов `escapeOnApply()` без аргумента теперь всегда включает экранирование при применении, даже если `escapes.value_on_apply` выключен.
Настройки отдельного поля описаны в разделе [Text](/docs/{{version}}/fields/text#unescape).

<a name="popover"></a>
#### Редактирование в popover

**Вероятность влияния: очень низкая**

Редактирование в popover через `updateOnPreview()` теперь экранирует значение, если поле не реализует `MoonShine\UI\Contracts\HasEscapedValueContract` или не вызывает `unescape()`.
Встроенные поля `Text`, `Textarea` и `BelongsTo` реализуют этот контракт.
Собственное поле с трейтом `WithEscapedValue` должно реализовать этот контракт, чтобы в popover сохранялись неэкранированные значения.

<a name="fields-components"></a>
### Поля и компоненты

<a name="views"></a>
#### Переопределенные представления

**Вероятность влияния: средняя**

В версии 5.0 изменились многие представления компонентов. Если в приложении опубликованы и изменены какие-либо из представлений ниже, сравните их с новыми версиями и обновите.

Представления, выводящие метки, подсказки и заголовки, теперь выводят подготовленные в PHP значения, например `$labelHtml`, `$hintHtml`, `$titleHtml` и `$valueHtml`, которые уже учитывают настройки [экранирования отображаемого текста](#display-escaping).
Опубликованная копия с `{!! $label !!}` обходит экранирование, а копия с `{{ $label }}` игнорирует `unescapeLabel()`.

- `moonshine::components.card`, `collapse`, `field-container`, `heading`, `modal`, `off-canvas`, `tabs`,
- `moonshine::components.form.fieldset`, `form.hint`, `form.wrapper`, `form.input-extensions.ext`, `form.input-extensions.prefix`,
- `moonshine::components.layout.box`, `layout.divider`, `layout.footer`,
- `moonshine::components.link-button`, `link-native`,
- `moonshine::components.menu.divider`, `menu.group`, `menu.item-link`,
- `moonshine::components.metrics.value`, `metrics.wrapped.value`,
- `moonshine::components.table.index`,
- `moonshine::fields.fieldset`, `fields.relationships.belongs-to-many`.

Несколько часто используемых представлений теперь выводят элементы напрямую, без вложенных Blade-компонентов.
Их данные тоже подготавливаются в PHP, например `$tagAttributes` и `$labelHtml` в представлении кнопки.

- `moonshine::components.action-button`,
- `moonshine::components.form.builder`,
- `moonshine::components.icon`,
- `moonshine::components.rating`,
- `moonshine::fields.hidden`.

Строки вертикальных таблиц по умолчанию, например на `DetailPage`, выводятся новым представлением `moonshine::components.table.vertical-field`.
Представления `layout.grid`, `layout.column` и `layout.div` для них больше не используются, поэтому их переопределения на эти строки не влияют.
Переопределяйте `moonshine::components.table.vertical-field`.
Строки, настроенные через замыкания `title` или `value` метода `vertical()`, по-прежнему используют компоненты.

<a name="file-extensions"></a>
#### Расширения файлов

**Вероятность влияния: низкая**

Поля `File` и `Image` наследуют новый глобальный список `allowed_extensions`, если у поля не вызван `allowedExtensions()`.
Значение по умолчанию `[]` разрешает все расширения, поэтому в существующих приложениях ничего менять не нужно.

Если ваш класс поля наследует `File` или `Image` и переобъявляет свойство `$allowedExtensions`, измените его тип на `?array`.
`null` означает, что поле следует глобальному списку.

```php
protected array $allowedExtensions = ['pdf']; // [tl! remove]
protected ?array $allowedExtensions = ['pdf']; // [tl! add]
```

Метод `allowedExtensions()` контракта `MoonShine\UI\Contracts\FileableContract` теперь принимает `array|string`.
Обновите его сигнатуру в собственных реализациях и переопределениях.

```php
public function allowedExtensions(array $allowedExtensions): static // [tl! remove]
public function allowedExtensions(array|string $allowedExtensions): static // [tl! add]
```

Атрибут `accept` по умолчанию теперь добавляется при рендере поля, поэтому до рендера `getAttribute('accept')` возвращает `null`, если у поля не вызывались `accept()` или `allowedExtensions()`.
Подробнее в разделе [File](/docs/{{version}}/fields/file#allowed-extensions).

<a name="link-urls"></a>
#### URL ссылок

**Вероятность влияния: низкая**

Компонент `Link` и ссылки поля `Url` теперь допускают только схемы `http`, `https`, `mailto` и `tel`, а также относительные URL и якоря.
Ссылки с другими схемами, например `javascript:` или `ftp:`, выводятся с `href="#"`.
Текст ссылки не меняется.

<a name="tables"></a>
#### Скелетон и спиннер таблиц

**Вероятность влияния: низкая**

Скелетон и спиннер выводятся только для асинхронных таблиц.
Методы `skeleton()` и `loader()` не влияют на синхронные таблицы.

<a name="dropdowns"></a>
#### Выпадающие меню

**Вероятность влияния: очень низкая**

Экземпляр Popper у выпадающего меню создается при первом открытии.
До этого свойство `popperInstance` Alpine-компонента `dropdown` равно `null`.
Проверяйте его перед вызовом методов из собственного JavaScript.

<a name="deprecated-apis"></a>
### Устаревшие API

<a name="removed-classes"></a>
#### Удаленные классы

**Вероятность влияния: средняя**

Классы, помеченные устаревшими в 4.x, удалены.

| Класс                                                                 | Замена                                                             |
|-----------------------------------------------------------------------|--------------------------------------------------------------------|
| `MoonShine\Laravel\Handlers\Handler`                                  | `MoonShine\Crud\Handlers\Handler`                                  |
| `MoonShine\Laravel\Handlers\Handlers`                                 | `MoonShine\Crud\Handlers\Handlers`                                 |
| `MoonShine\Laravel\Notifications\NotificationButton`                  | `MoonShine\Crud\Notifications\NotificationButton`                  |
| `MoonShine\Laravel\Http\Responses\MoonShineJsonResponse`              | `MoonShine\Crud\JsonResponse`                                      |
| `MoonShine\Laravel\Http\Requests\Relations\AsyncSearchRequest`        | `MoonShine\Laravel\Http\Requests\Relations\RelationModelFieldRequest` |
| `MoonShine\Laravel\MoonShineUI`                                       | Хелпер `toast()` вместо `MoonShineUI::toast()`                     |

```php
use MoonShine\Laravel\Handlers\Handler; // [tl! remove]
use MoonShine\Crud\Handlers\Handler; // [tl! add]

use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse; // [tl! remove]
use MoonShine\Crud\JsonResponse; // [tl! add]

MoonShineUI::toast('Saved'); // [tl! remove]
toast('Saved'); // [tl! add]
```

<a name="configuration"></a>
### Конфигурация

<a name="config-values"></a>
#### Значения конфигурации

**Вероятность влияния: низкая**

Значения конфигурации теперь проверяются при чтении, а некорректное значение вызывает `TypeError`.

- `middleware`, `auth.pipelines` и `pages` должны быть массивами строк, например имен классов.
  Замыкания и объекты в `auth.pipelines` больше не поддерживаются, поэтому регистрируйте каждый pipeline как класс.
- `pages` должен содержать классы страниц, `layout` должен наследовать `MoonShine\Crud\Layouts\AbstractLayout`,
  а `palette` должен реализовывать `MoonShine\Contracts\ColorManager\PaletteContract`.

```php filename:config/moonshine.php
'auth' => [
    'pipelines' => [
        static fn ($request, $next) => $next($request), // [tl! remove]
        \App\MoonShine\AuthPipelines\TwoFactorAuthentication::class, // [tl! add]
    ],
],
```

<a name="extending"></a>
### Расширение MoonShine

<a name="request"></a>
#### Обертка запроса

**Вероятность влияния: очень низкая**

Свойство `$request` класса `MoonShine\Core\AbstractRequest` теперь имеет тип `ServerRequestInterface|Closure`.
PSR-запрос создается лениво, при чтении данных запроса.

Если ваш класс наследует `AbstractRequest` и читает `$this->request` напрямую, используйте метод `getRequest()`.

```php
$this->request->getQueryParams(); // [tl! remove]
$this->getRequest()->getQueryParams(); // [tl! add]
```

<a name="contracts"></a>
#### Контракты

**Вероятность влияния: очень низкая**

Если ваши классы реализуют контракты **MoonShine** напрямую, а не наследуют базовые классы, добавьте новые методы:

- `MoonShine\Contracts\UI\ComponentContract`: `when()` и `unless()`, например через трейт `Illuminate\Support\Traits\Conditionable`,
- `MoonShine\Contracts\Core\DependencyInjection\TranslatorContract`: `getString()`,
- `MoonShine\Contracts\Core\HasResourceContract`: `getResourceOrFail()`, его реализует трейт `MoonShine\Core\Traits\HasResource`,
- `MoonShine\Crud\Contracts\Notifications\NotificationButtonContract`: `toArray()`.

`RequestContract::getScalar()` теперь возвращает `string|int|float|bool|null` вместо `mixed`. Обновите тип возврата в собственных реализациях.

Новые контракты экранирования, например `HasLabelEscapingContract` или `HasEscapedValueContract`, необязательны.
