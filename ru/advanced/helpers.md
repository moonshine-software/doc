# Хелперы

- [Основные](#basic)
- [Ссылка на страницу `to_page`](#to_page)
- [FormBuilder](#form_builder)
- [TableBuilder](#table_builder)
- [ActionButton](#action_button)
- [Найти класс применения поля (фильтра)](#find_field_apply)
- [Отобразить 404](#oops404)

---

<a name="basic"></a>
## Основные

```php
moonshine() // Экземпляр MoonShine
moonshineRegister() // Для регистрации классов применения
moonshineRequest() // С доступом к ресурсу, страницам, постам и компонентам
moonshineAssets() // Работа с ассетами (экземпляр MoonShineAssets)
moonshineMenu() // Получить список меню
moonshineLayout() // Отрендерить содержимое шаблона
```

<a name="to_page"></a>
## Ссылка на страницу `to_page`

- $page - Страница или псевдоним страницы (Опционально)
- $resource - Ресурс или псевдоним ресурса (Опционально)
- $params - Дополнительный запрос
- $redirect - Если необходимо выполнить редирект немедленно
- $fragment - URL будет использоваться для загрузки фрагмента

```php
to_page(page: 'form-page');
to_page(page: IndexPage::class);
to_page(page: IndexPage::class, resource: PostResource::class);
to_page(page: new IndexPage(), resource: new PostResource());
to_page(page: 'form-page', redirect: true);
to_page(page: 'form-page', fragment: true);
```

<a name="form_builder"></a>
## FormBuilder

```php
form(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
```

<a name="table_builder"></a>
## TableBuilder

```php
tabel(
    Fields|array $fields = [],
    iterable $items = [],
    ?LengthAwarePaginator $paginator = null
)
```

<a name="action_button"></a>
## ActionButton

```php
actionBtn(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
```

<a name="find_field_apply"></a>
## Найти класс применения поля (фильтра)

```php
findFieldApply(
    Field $field,
    string $type,
    string $for
);

findFieldApply($field, 'filters', ModelResource::class);
```

<a name="oops404"></a>
## Отобразить 404

```php
oops404()
```
