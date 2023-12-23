<x-page title="Helpers" :sectionMenu="null">
<x-sub-title>Базовые</x-sub-title>

<x-code>
moonshine() // MoonShine instance
moonshineRegister() // Для регистрации apply классов
moonshineRequest() // С доступом к ресурсу, страницам, записям и компонентам
moonshineAssets() // Работа с ассетами (MoonShineAssets instance)
moonshineMenu() // Получить список меню
moonshineLayout() // Рендерить содержимое шаблона
</x-code>

<x-sub-title>Ссылка на страницу <code>to_page</code></x-sub-title>

<x-p>
    $page - Страница или alias страницы (Опционально)<br>
    $resource - Ресурс или alias ресурса (Опционально)<br>
    $params - Дополнительный query<br>
    $redirect - При необходимости сразу выполнить редирект<br>
    $fragment - Урл будет использован для Fragment загрузки
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
table(
    Fields|array $fields = [],
    iterable $items = [],
    ?LengthAwarePaginator $paginator = null
)
</x-code>

<x-sub-title>ActionButton</x-sub-title>

<x-code>
actionBtn(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<x-sub-title>Найти apply класс поля(фильтра)</x-sub-title>

<x-code>
findFieldApply(
    Field $field,
    string $type,
    string $for
);

findFieldApply($field, 'filters', ModelResource::class);
</x-code>

<x-sub-title>Отобразить 404</x-sub-title>

<x-code>
oops404()
</x-code>
</x-page>
