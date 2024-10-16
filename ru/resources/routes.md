# Маршруты

  - [Основы](#basics)
  - [Helper](#helper)
  - [Текущая страница](#current-page)

---

<a name="basics"></a>
## Основы

```php
$resource->url(); // Первая страница ресурса

$resource->route($name, $key, $params); // Расширенный метод для получения маршрутов

$resource->pageUrl($page, $params, $fragment); // Расширенный метод для получения маршрута страницы

$resource->indexPageUrl(); // страница индекса
$resource->indexPageUrl(['query-tag' => $tag->uri()]); // query tag

$resource->formPageUrl(); // страница создания
$resource->formPageUrl(1); // страница редактирования по int
$resource->formPageUrl($item); // страница редактирования по Model

$resource->detailPageUrl(1); // детальная страница по int
$resource->detailPageUrl($item); // детальная страница по Model

$resource->asyncMethodUrl('updateSomething'); // ANY
$resource->fragmentLoadUrl('table-index', $resource->formPage());

// CRUD
$resource->route('crud.update', $data->getKey()); // PUT
$resource->route('crud.store')); // POST
$resource->route('crud.destroy', $data->getKey()); // DELETE
$resource->route('crud.massDelete'); // DELETE

// Обработчики
$resource->route('handler', query: ['handlerUri' => $export->uriKey()]);
```
```php
$page->url(); // url страницы
$page->route($params);  // Расширенный метод для получения маршрутов


$page->asyncMethodUrl('updateSomething'); // ANY

$page->fragmentLoadUrl('table-index');
```

<a name="helper"></a>
## Helper

Вы также можете использовать хелпер `to_page`:

```php
to_page(
    string|Page|null $page = null,
    string|ResourceContract|null $resource = null,
    array $params = [],
    bool $redirect = false,
    ?string $fragment = null
) 
```

-`$page` - страница или псевдоним страницы (необязательно),
-`$resource` - ресурс или псевдоним ресурса (необязательно),
-`$params` - дополнительный запрос,
-`$redirect` - если необходимо, выполнить редирект немедленно,
-`$fragment` - url будет использоваться для загрузки фрагмента.

```php
to_page(page: PageType::FORM);
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: PageType::FORM, redirect: true);
to_page(page: PageType::FORM, fragment: true);
```

> [!TIP] 
> Для получения дополнительной информации о типах страниц см. [PageType](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages#page-type).

<a name="current-page"></a>
## Текущая страница

Ресурс модели имеет методы, которые позволяют проверить, какая страница является текущей, для построения дальнейшей логики.

```php
$resource->isNowOnIndex(); // страница индекса
$resource->isNowOnForm(); // страница создания или редактирования
$resource->isNowOnCreateForm(); // страница создания
$resource->isNowOnUpdateForm(); // страница редактирования
$resource->isNowOnDetail(); // детальная страница
```

