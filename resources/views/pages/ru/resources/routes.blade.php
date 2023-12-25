<x-page title="Маршруты" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#helper', 'label' => 'Helper'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

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

<x-sub-title id="helper">Helper</x-sub-title>

<x-p>
    Также можно воспользоваться хелпером <code>to_page</code>:
</x-p>

<x-code language="php">
to_page(
    string|Page|null $page = null,
    string|ResourceContract|null $resource = null,
    array $params = [],
    bool $redirect = false,
    ?string $fragment = null
)
</x-code>

<x-ul>
    <li><code>$page</code> - страница или alias страницы (опционально),</li>
    <li><code>$resource</code> - ресурс или alias ресурса (опционально),</li>
    <li><code>$params</code> - дополнительный query,</li>
    <li><code>$redirect</code> - при необходимости сразу выполнить редирект,</li>
    <li><code>$fragment</code> - url будет использован для Fragment загрузки.</li>
</x-ul>

<x-code>
to_page(page: 'form-page');
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: 'form-page', redirect: true);
to_page(page: 'form-page', fragment: true);
</x-code>

</x-page>
