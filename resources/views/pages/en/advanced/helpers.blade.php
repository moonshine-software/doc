<x-page title="Helpers" :sectionMenu="null">
<x-sub-title>Basic</x-sub-title>

<x-code>
moonshine() // MoonShine instance
moonshineRegister() // To register apply classes
moonshineRequest() // With access to resource, pages, posts and components
moonshineAssets() // Working with assets (MoonShineAssets instance)
moonshineMenu() // Get menu list
moonshineLayout() // Render template contents
</x-code>

<x-sub-title>Link to page <code>to_page</code></x-sub-title>

<x-p>
    $page - Page or page alias (Optional)<br>
    $resource - Resource or resource alias (Optional)<br>
    $params - Additional query<br>
    $redirect - If necessary, perform a redirect immediately<br>
    $fragment - URL will be used for Fragment loading
</x-p>

<x-code>
to_page(page: 'form-page');
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: 'form-page', redirect: true);
to_page(page: 'form-page', fragment: true);
</x-code>

<x-sub-title>FormBuilder</x-sub-title>

<x-code>
form(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
</x-code>

<x-sub-title>TableBuilder</x-sub-title>

<x-code>
form(
    Fields|array $fields = [],
    iterable $items = [],
    ?LengthAwarePaginator $paginator = null
)
</x-code>

<x-sub-title>TableBuilder</x-sub-title>

<x-code>
actionBtn(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<x-sub-title>Find apply field (filter) class</x-sub-title>

<x-code>
findFieldApply(
    Field $field,
    string $type,
    string $for
);

findFieldApply($field, 'filters', ModelResource::class);
</x-code>

<x-sub-title>Display 404</x-sub-title>

<x-code>
oops404()
</x-code>
</x-page>
