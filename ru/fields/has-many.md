# HasMany

- [Основы](#basics)
- [Поля](#fields)
- [Создание объекта отношения](#creatable)
- [Количество записей](#limit)
- [Только ссылка](#only-link)
- [ID родителя](#parent-id)
- [Кнопка редактирования](#change-edit-button)
- [Модальное окно](#without-modals)
- [Модификация](#modify)
- [Добавление ActionButtons](#add-action-buttons)
- [Продвинутое использование](#advanced)

---

<a name="basics"></a>
## Основы

Поле *HasMany* предназначено для работы с отношением того же имени в Laravel и включает все [Базовые методы](/docs/{{version}}/fields/basic-methods).

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
Ресурс также необходимо [зарегистрировать](/docs/{{version}}/resources#define) в сервис-провайдере `MoonShineServiceProvider` в методе `menu()` или `resources()`. В противном случае будет ошибка 500 (Resource is required for MoonShine\Laravel\Fields\Relationships\HasMany...).

```php
use MoonShine\UI\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
```

![has_many](https://moonshine-laravel.com/screenshots/has_many.png)

![has_many_dark](https://moonshine-laravel.com/screenshots/has_many_dark.png)

Вы можете опустить `$resource`, если ресурс модели совпадает с названием связи.

```php
class CommentResource extends ModelResource
{
    //...
}
//...
HasMany::make('Comments', 'comments')
```

Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label` (по правилам camelCase). 

```php
class CommentResource extends ModelResource
{
    //...
}
//...
BelongsToMany::make('Comments')
```

<a name="fields"></a>
## Поля

Метод `fields()` позволяет установить поля, которые будут отображаться в *preview*.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
use MoonShine\UI\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Text;

HasMany::make('Comments', resource: CommentResource::class)
    ->fields([
        BelongsTo::make('User'),
        Text::make('Text'),
    ])
```

![has_many_fields](https://moonshine-laravel.com/screenshots/has_many_fields.png)

![has_many_fields_dark](https://moonshine-laravel.com/screenshots/has_many_fields_dark.png)

<a name="creatable"></a>
## Создание объекта отношения

Метод `creatable()` позволяет создать новый объект отношения через модальное окно.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButtonContract $button = null,
)
```

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->creatable()
```

![has_many_creatable](https://moonshine-laravel.com/screenshots/has_many_creatable.png)

![has_many_creatable_dark](https://moonshine-laravel.com/screenshots/has_many_creatable_dark.png)

Вы можете настроить *кнопку* создания, передав параметр button в метод.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->creatable(
        button: ActionButton::make('Custom button', '')
    )
```

<a name="limit"></a>
## Количество записей

Метод `limit()` позволяет ограничить количество записей, отображаемых в *preview*.

```php
limit(int $limit)
```

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->limit(1)
```

<a name="only-link"></a>
## Только ссылка

Метод `relatedLink()` позволит отобразить отношение в виде ссылки с количеством элементов. Ссылка будет вести на IndexPage дочернего ресурса из отношения HasMany, в котором буду показаны только данные элементы.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

Вы можете передать в метод необязательные параметры:
- `linkRelation` - ссылка на отношение,
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink()
```
![has_many_link](https://moonshine-laravel.com/screenshots/has_many_link.png)

![has_many_link_dark](https://moonshine-laravel.com/screenshots/has_many_link_dark.png)

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink('comment')
```

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink(condition: function (int $count, Field $field): bool {
        return $count > 10;
    })
```

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

> [!TIP]
> TODO
> Рецепт: [сохранение файлов](/docs/{{version}}/recipes#hasmany-parent-id) связей *HasMany* в директории с ID родителя.

<a name="change-edit-button"></a>
## Кнопка редактирования

Метод `changeEditButton()` позволяет полностью переопределить кнопку редактирования.

```php
HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->changeEditButton(
        ActionButton::make(
            'Edit',
            fn(Comment $comment) => (new CommentResource())->formPageUrl($comment)
        )
    )
```

<a name="without-modals"></a>
## Модальное окно

По умолчанию создание и редактирование записи поля *HasMany* происходит в модальном окне, метод `withoutModals()` позволяет отключить это поведение.

```php
HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->withoutModals()
```

<a name="modify"></a>
## Модификация

Поле *HasMany* имеет методы, которые можно использовать для модификации кнопок, изменения *TableBuilder* для предпросмотра и формы, а также изменения кнопки *relatedLink*.

### modifyItemButtons()

Метод `modifyItemButtons()` позволяет изменить кнопки просмотра, редактирования, удаления и массового удаления.

```php
/**
 * @param  Closure(ActionButtonContract $detail, ActionButtonContract $edit, ActionButtonContract $delete, ActionButtonContract $massDelete, static $ctx): array  $callback
 */
modifyItemButtons(Closure $callback)
```

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->modifyItemButtons(
        fn(ActionButton $detail, $edit, $delete, $massDelete, HasMany $ctx) => [$detail]
    )
```

### modifyRelatedLink()

Метод `modifyRelatedLink()` позволяет изменить кнопку *relatedLink*.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink()
    ->modifyRelatedLink(
        fn(ActionButton $button, bool $preview) => $button
            ->when($preview, fn(ActionButton $btn) => $btn->primary())
            ->unless($preview, fn(ActionButton $btn) => $btn->secondary())
    )
```

### modifyCreateButton() / modifyEditButton()

Методы `modifyCreateButton()` и `modifyEditButton()` позволяют изменить кнопки создания и редактирования.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->modifyCreateButton(
        fn(ActionButton $button) => $button->setLabel('Custom create button')
    )
    ->modifyEditButton(
        fn(ActionButton $button) => $button->setLabel('Custom edit button')
    )
    ->creatable(true)
```

### modifyTable()

Метод `modifyTable()` позволяет изменить *TableBuilder* для предпросмотра и формы.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table
            ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
            ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
    )
```

<a name="add-action-buttons"></a>
## Добавление ActionButtons

### indexButtons()

Метод `indexButtons` позволяет добавить дополнительные ActionButtons для работы с элементами HasMany

```php
HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->indexButtons([
        ActionButton::make('Custom button')
    ])
```

### formButtons()

Метод `formButtons` позволяет добавить дополнительные ActionButtons внутри формы при создании или редактировании элемента HasMany

```php
HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->formButtons([
        ActionButton::make('Custom form button')
    ])
```

<a name="advanced"></a>
## Продвинутое использование

### Отношение через JSON поле
Поле *HasMany* по умолчанию отображается вне основной формы ресурса. Если вам нужно отобразить поля отношения внутри основной формы, то вы можете использовать поле *JSON* в режиме `asRelation()`.

```php
Json::make('Comments', 'comments')
    ->asRelation(new CommentResource())
    //...
```

### Отношение через поле Template

Используя *поле Template*, вы можете построить поле для отношений *HasMany*, используя fluent интерфейс в процессе декларации.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле Template](/docs/{{version}}/fields/template).