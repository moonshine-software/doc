<x-page title="Маршруты" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#helper', 'label' => 'Helper'],
        ['url' => '#current-page', 'label' => 'Текущая страница'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

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
to_page(page: PageType::FORM);
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: PageType::FORM, redirect: true);
to_page(page: PageType::FORM, fragment: true);
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией о типах страниц обратитесь к разделу
    <x-link link="{{ to_page('resources-pages') }}#page-type">PageType</x-link>.
</x-moonshine::alert>

<x-sub-title id="current-page">Текущая страница</x-sub-title>

<x-p>
    Ресурс модели имеет методы позволяющие проверить какой страницей является текущая для построения дальнейшей логики.
</x-p>

<x-code language="php">
$resource->isNowOnIndex(); // индексная страница
$resource->isNowOnForm(); // страница создания или редактирования
$resource->isNowOnCreateForm(); // страница создания
$resource->isNowOnUpdateForm(); // страница редактирования
$resource->isNowOnDetail(); // детальная страница
</x-code>

</x-page>
