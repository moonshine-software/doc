---
title: Upgrade guide
---

# Руководство по обновлению MoonShine 4.x → 5.0

- [Требования](#requirements)
- [Обновление зависимостей](#update-dependencies)
- [Значения конфигурации](#config-values)
- [Удаленные классы](#removed-classes)
- [Фильтры, теги запросов и обработчики](#index-page)
- [Импорт и экспорт](#import-export)
- [Экранирование отображаемого текста](#display-escaping)
- [Экранирование значений полей](#value-escaping)
- [Расширения файлов](#file-extensions)
- [URL ссылок](#link-urls)
- [Переопределенные представления](#views)
- [Таблицы](#tables)
- [Обертка запроса](#request)
- [Выпадающие меню](#dropdowns)
- [Контракты](#contracts)

---

> [!NOTE]
> Руководство дополняется и будет расширено до выхода версии 5.0.
> Для обновления с 3.x сначала выполните [руководство по обновлению 4.x](/docs/4.x/upgrade-guide).

<a name="requirements"></a>
## Требования

Для **MoonShine** 5.0 требуются:

- PHP 8.4 или новее,
- Laravel 11, 12 или 13.

Laravel 10 больше не поддерживается.

<a name="update-dependencies"></a>
## Обновление зависимостей

Измените версию пакета в composer.json и обновите зависимости.

```json
{
    "require": {
        "moonshine/moonshine": "^5.0"
    }
}
```

```shell
composer update
```

Если вы используете [импорт и экспорт](#import-export), обновите также `moonshine/import-export` до версии 3.

Для **MoonShine** 5.0 требуются `symfony/http-foundation` и `symfony/psr-http-message-bridge` версии 7.4 или 8.1.
Если Composer не может их установить из-за зафиксированных старых версий, обновите пакет вместе с зависимостями:

```shell
composer update moonshine/moonshine -W
```

<a name="config-values"></a>
## Значения конфигурации

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

<a name="removed-classes"></a>
## Удаленные классы

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

<a name="index-page"></a>
## Фильтры, теги запросов и обработчики

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
## Импорт и экспорт

**MoonShine** 5.0 работает с `moonshine/import-export` 3.x.

```json
{
    "require": {
        "moonshine/import-export": "^3.0"
    }
}
```

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

<a name="display-escaping"></a>
## Экранирование отображаемого текста

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
## Экранирование значений полей

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

<a name="file-extensions"></a>
## Расширения файлов

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
## URL ссылок

Компонент `Link` и ссылки поля `Url` теперь допускают только схемы `http`, `https`, `mailto` и `tel`, а также относительные URL и якоря.
Ссылки с другими схемами, например `javascript:` или `ftp:`, выводятся с `href="#"`.
Текст ссылки не меняется.

<a name="views"></a>
## Переопределенные представления

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

<a name="tables"></a>
## Таблицы

Скелетон и спиннер выводятся только для асинхронных таблиц.
Методы `skeleton()` и `loader()` не влияют на синхронные таблицы.

<a name="request"></a>
## Обертка запроса

Свойство `$request` класса `MoonShine\Core\AbstractRequest` теперь имеет тип `ServerRequestInterface|Closure`.
PSR-запрос создается лениво, при чтении данных запроса.

Если ваш класс наследует `AbstractRequest` и читает `$this->request` напрямую, используйте метод `getRequest()`.

```php
$this->request->getQueryParams(); // [tl! remove]
$this->getRequest()->getQueryParams(); // [tl! add]
```

<a name="dropdowns"></a>
## Выпадающие меню

Экземпляр Popper у выпадающего меню создается при первом открытии.
До этого свойство `popperInstance` Alpine-компонента `dropdown` равно `null`.
Проверяйте его перед вызовом методов из собственного JavaScript.

<a name="contracts"></a>
## Контракты

Если ваши классы реализуют контракты **MoonShine** напрямую, а не наследуют базовые классы, добавьте новые методы:

- `MoonShine\Contracts\UI\ComponentContract`: `when()` и `unless()`, например через трейт `Illuminate\Support\Traits\Conditionable`,
- `MoonShine\Contracts\Core\DependencyInjection\TranslatorContract`: `getString()`,
- `MoonShine\Contracts\Core\HasResourceContract`: `getResourceOrFail()`, его реализует трейт `MoonShine\Core\Traits\HasResource`,
- `MoonShine\Crud\Contracts\Notifications\NotificationButtonContract`: `toArray()`.

`RequestContract::getScalar()` теперь возвращает `string|int|float|bool|null` вместо `mixed`. Обновите тип возврата в собственных реализациях.

Новые контракты экранирования, например `HasLabelEscapingContract` или `HasEscapedValueContract`, необязательны.
Редактирование в popover через `updateOnPreview()` экранирует значение, если поле не реализует `MoonShine\UI\Contracts\HasEscapedValueContract` или не вызывает `unescape()`.
Собственное поле с трейтом `WithEscapedValue` должно реализовать этот контракт, чтобы в popover сохранялись неэкранированные значения.
