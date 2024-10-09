# HasOne

   - [Основы](#basics)
   - [Поля](#fields)
   - [ID родителя](#parent-id)

<a name="basics"></a>
## Основы

Поле *HasOne* предназначено для работы с отношением того же имени в Laravel и включает все базовые методы.

Для создания этого поля используйте статический метод `make()`.

```php
HasOne::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
```

`$label` - метка, заголовок поля,
`$relationName` - имя отношения,
`$resource` - ресурс модели, на который ссылается отношение

> [!CAUTION]
> Параметр `$formatted` не используется в поле HasOne!

> [!WARNING]
> Наличие ресурса модели, на который ссылается отношение, обязательно!  
> Ресурс также необходимо [зарегистрировать](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) в сервис-провайдере *MoonShineServiceProvider* в методе `menu()` или `resources()`. В противном случае будет ошибка 404.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', 'profile', resource: new ProfileResource()) 
    ];
}
 
//...

```

![has_one](https://moonshine-laravel.com/screenshots/has_one.png)
![has_one_dark](https://moonshine-laravel.com/screenshots/has_one_dark.png)

> [!TIP]
> Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label`.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', resource: new ProfileResource()) 
    ];
}
 
//...
```

> [!TIP]
> Вы можете опустить `$resource`, если ресурс модели соответствует имени отношения.

```php
use MoonShine\Fields\Relationships\HasOne; 
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Profile', 'profile') 
    ];
}
 
//...
```

<a name="fields"></a>
## Поля

Метод `fields()` позволяет указать, какие поля будут участвовать в *preview* или в построении форм.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
 
//...
 
public function fields(): array
{
    return [
        HasOne::make('Contacts', resource: new ContactResource())
            ->fields([
                Phone::make('Phone'),
                Text::make('Address'),
            ]) 
    ];
}
 
//...
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

```
$this->getParentId();
```

> [!TIP]
> Рецепт: [сохранение файлов](https://moonshine-laravel.com/docs/resource/recipes/recipes#hasmany-parent-id) связей *HasMany* в директории с ID родителя.
