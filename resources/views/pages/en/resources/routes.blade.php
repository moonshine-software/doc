<x-page title="Routes" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#helper', 'label' => 'Helper'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-code language="php">
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
</x-code>

<x-code language="php">
$page->url(); // page url
$page->route($params);  // Advanced method for obtaining routes


$page->asyncMethodUrl('updateSomething'); // ANY

$page->fragmentLoadUrl('table-index');
</x-code>

<x-sub-title id="helper">Helper</x-sub-title>

<x-p>
    You can also use the <code>to_page</code> helper:
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
    <li><code>$page</code> - page or page alias (optional),</li>
    <li><code>$resource</code> - resource or resource alias (optional),</li>
    <li><code>$params</code> - additional query,</li>
    <li><code>$redirect</code> - if necessary, perform a redirect immediately,</li>
    <li><code>$fragment</code> - url will be used for Fragment loading.</li>
</x-ul>

<x-code>
to_page(page: PageType::FORM);
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: PageType::FORM, redirect: true);
to_page(page: PageType::FORM, fragment: true);
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more information about page types, see
    <x-link link="{{ to_page('resources-pages') }}#page-type">PageType</x-link>.
</x-moonshine::alert>

</x-page>
