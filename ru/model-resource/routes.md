---
video: https://youtu.be/pC-wVnpypVI?si=ZS5lzg3-VyBk30Za&t=1159
---

# Routes

- [Основы](#basics)
- [Хелпер](#helper)
- [Активная страница](#active-page)
- [Проверка активной страницы](#is-page)

---

<a name="basics"></a>
## Основы

```php
// Первая страница ресурса
$resource->getUrl();

// Расширенный метод получения маршрутов
$resource->getRoute($name, $key, $params);

// Расширенный способ получения маршрута страницы
$resource->getPageUrl($page, $params, $fragment);

// Индексная страница
$resource->getIndexPageUrl();
// Query tag
$resource->getIndexPageUrl(['query-tag' => $tag->uri()]);

// Страница создания
$resource->getFormPageUrl();
// Страница редактирования по int
$resource->getFormPageUrl(1);
// Страница редактирования по Model
$resource->getFormPageUrl($item);

// Детальная страница по int
$resource->getDetailPageUrl(1);
// Детальная страница по Model
$resource->getDetailPageUrl($item);

// ANY
$resource->getAsyncMethodUrl('updateSomething');
$resource->getFragmentLoadUrl('table-index', $resource->formPage());

// CRUD

// PUT
$resource->getRoute('crud.update', $data->getKey());
// POST
$resource->getRoute('crud.store');
// DELETE
$resource->getRoute('crud.destroy', $data->getKey());
// DELETE
$resource->getRoute('crud.massDelete');

// Handlers
$resource->getRoute('handler', query: ['handlerUri' => $export->getUriKey()]);
```

<a name="helper"></a>
## Helper
Также можно воспользоваться хелпером `toPage()`.

```php
toPage(
    string|PageContract|null $page = null,
    string|ResourceContract|null $resource = null,
    array $params = [],
    bool $redirect = false,
    ?string $fragment = null
)
```

- `$page` - страница или class-string страницы (опционально),
- `$resource` - ресурс или class-string ресурса (опционально),
- `$params` - дополнительный query (опционально),
- `$redirect` - при необходимости сразу выполнить редирект (опционально),
- `$fragment` - url будет использован для Fragment загрузки (опционально).

```php
toPage(page: CustomPage::class);
toPage(page: IndexPage::class, resource: PostResource::class);
toPage(page: CustomPage::class, redirect: true);
toPage(page: CustomPage::class, fragment: true);
```

<a name="active-page"></a>
## Активная страница

`ModelResource` имеет метод `getActivePage()`, который позволяет получить текущую активную страницу.
Если активной страницы нет, то результат будет `NULL`.

```php
$resource->getActivePage() // ?PageContract

if($resource->getActivePage() instanceof IndexPage)

if($resource->getActivePage() instanceof FormPage)

if($resource->getActivePage() instanceof DetailPage)
```

Вы также можете изменить активную страницу. Это полезно, если вы используете собственный контроллер и необходимо указать ресурсу активную страницу для текущего запроса.

```php
$resource->setActivePage(
    $resource->getIndexPage()
);
```

<a name="is-page"></a>
## Проверка активной страницы

```php
public function isIndexPage(): bool;

public function isFormPage(): bool;

public function isDetailPage(): bool;

public function isCreateFormPage(): bool;

public function isUpdateFormPage(): bool;
```
