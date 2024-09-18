https://moonshine-laravel.com/docs/resource/advanced/advanced-helpers?change-moonshine-locale=en

------
# Helpers

- [Basic](#basic)
- [Link to page `to_page`](#to_page)
- [FormBuilder](#form_builder)
- [TableBuilder](#table_builder)
- [ActionButton](#action_button)
- [Find apply field (filter) class](#find_field_apply)
- [Display 404](#oops404)

<a name="basic"></a>
## Basic

```php
moonshine() // MoonShine instance
moonshineRegister() // To register apply classes
moonshineRequest() // With access to resource, pages, posts and components
moonshineAssets() // Working with assets (MoonShineAssets instance)
moonshineMenu() // Get menu list
moonshineLayout() // Render template contents
```

<a name="to_page"></a>
## Link to page `to_page`

- $page - Page or page alias (Optional)
- $resource - Resource or resource alias (Optional)
- $params - Additional query
- $redirect - If necessary, perform a redirect immediately
- $fragment - URL will be used for Fragment loading

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
## Find apply field (filter) class

```php
findFieldApply(
    Field $field,
    string $type,
    string $for
);

findFieldApply($field, 'filters', ModelResource::class);
```

<a name="oops404"></a>
## Display 404

```php
oops404()
```
