# HasOne

- [Основы](#basics)
- [Поля](#fields)
- [ID родителя](#parent-id)

---

<a name="basics"></a>
## Основы

Поле *HasOne* предназначено для работы с отношением того же имени в Laravel и включает все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Для создания этого поля используйте статический метод `make()`.

```php
HasMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - метка, заголовок поля,
- `$relationName` - имя отношения,
- `$resource` - ресурс модели, на который ссылается отношение.

> [!CAUTION]
> Параметр `$formatted` не используется в поле `HasMany`!

> [!WARNING]
> Наличие ресурса модели, на который ссылается отношение, обязательно.
Ресурс также необходимо [зарегистрировать](/docs/{{version}}/resources#define) в сервис-провайдере `MoonShineServiceProvider` в методе `menu()` или `resources()`. В противном случае будет ошибка 500 (Resource is required for MoonShine\Laravel\Fields\Relationships\HasOne...).

```php
HasOne::make('Profile', 'profile', resource: ProfileResource::class) 
```

![has_one](https://moonshine-laravel.com/screenshots/has_one.png)

![has_one_dark](https://moonshine-laravel.com/screenshots/has_one_dark.png)

Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label` (по правилам camelCase).

```php
class ProfileResource extends ModelResource
{
    //...
}
//...
HasMany::make('Profile', 'profile')
```

Вы можете опустить `$resource`, если ресурс модели совпадает с названием связи.

```php
class ProfileResource extends ModelResource
{
    //...
}
//...
HasMany::make('Profile')
```

<a name="fields"></a>
## Поля

Метод `fields()` позволяет указать, какие поля будут участвовать в *preview* или в построении форм.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
use MoonShine\UI\Fields\Relationships\HasOne;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;

HasOne::make('Contacts', resource: ContactResource::class)
    ->fields([
        Phone::make('Phone'),
        Text::make('Address'),
    ]) 
```

![has_one_preview](https://moonshine-laravel.com/screenshots/has_one_preview.png)

![has_one_preview_dark](https://moonshine-laravel.com/screenshots/has_one_preview_dark.png)

<a name="parent-id"></a>
## ID родителя

Если у отношения есть ресурс, и вы хотите получить ID родительского элемента, то вы можете использовать трейт *ResourceWithParent*.

```php
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;
    //...
}
```

При использовании трейта необходимо определить методы:

```php
protected function getParentResourceClassName(): string
{
    return PostResource::class;
}

protected function getParentRelationName(): string
{
    return 'post';
}
```

Для получения ID родителя используйте метод `getParentId()`.

```php
$this->getParentId();
```
