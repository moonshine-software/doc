https://moonshine-laravel.com/docs/resource/models-resources/resources-routes?change-moonshine-locale=en

------
# Routes

  - [Basics](#basics)
  - [Helper](#helper)
  - [Current page](#current-page)

<a name="basics"></a>
## Basics

```php
$resource->url(); // First page of the resource

$resource->route($name, $key, $params); // Advanced method for obtaining routes

$resource->pageUrl($page, $params, $fragment); // Advanced method for obtaining page`s route

$resource->indexPageUrl(); // index page
$resource->indexPageUrl(['query-tag' => $tag->uri()]); // query tag

$resource->formPageUrl(); // create page
$resource->formPageUrl(1); // edit page by int
$resource->formPageUrl($item); // edit page by Model

$resource->detailPageUrl(1); // detail page by int
$resource->detailPageUrl($item); // detail page by Model

$resource->asyncMethodUrl('updateSomething'); // ANY
$resource->fragmentLoadUrl('table-index', $resource->formPage());

// CRUD
$resource->route('crud.update', $data->getKey()); // PUT
$resource->route('crud.store')); // POST
$resource->route('crud.destroy', $data->getKey()); // DELETE
$resource->route('crud.massDelete'); // DELETE

// Handlers
$resource->route('handler', query: ['handlerUri' => $export->uriKey()]);
```
```php
$page->url(); // page url
$page->route($params);  // Advanced method for obtaining routes


$page->asyncMethodUrl('updateSomething'); // ANY

$page->fragmentLoadUrl('table-index');
```

<a name="helper"></a>
## Helper
You can also use the `to_page` helper:

```php
to_page(
    string|Page|null $page = null,
    string|ResourceContract|null $resource = null,
    array $params = [],
    bool $redirect = false,
    ?string $fragment = null
) 
```

-`$page` - page or page alias (optional),
-`$resource` - resource or resource alias (optional),
-`$params` - additional query,
-`$redirect` - if necessary, perform a redirect immediately,
-`$fragment` - url will be used for Fragment loading.

```php
to_page(page: PageType::FORM);
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: PageType::FORM, redirect: true);
to_page(page: PageType::FORM, fragment: true);
```

> [!TIP] 
> For more information about page types, see [PageType](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages#page-type).

<a name="current-page"></a>
## Current page
The model resource has methods that allow you to check which page is the current one to build further logic.

```php
$resource->isNowOnIndex(); // index page
$resource->isNowOnForm(); // creation or editing page
$resource->isNowOnCreateForm(); // creation page
$resource->isNowOnUpdateForm(); // edit page
$resource->isNowOnDetail(); // detail page
```

