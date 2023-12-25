<x-page title="Маршруты" :sectionMenu="[]">

<x-p>
    Сахар для роутов:
</x-p>

<x-code language="php">
$resource->url(); // First page of the resource

$resource->route($name, $key, $params); // Advanced method for obtaining routes

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
</x-code>

<x-code language="php">
$page->url(); // page url
$page->route($params);  // Advanced method for obtaining routes


$page->asyncMethodUrl('updateSomething'); // ANY

$page->fragmentLoadUrl('table-index');
</x-code>

</x-page>
