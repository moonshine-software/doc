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
   - [Продвинутое использование](#advanced)

<a name="basics"></a> 
## Основы

Поле *HasMany* предназначено для работы с отношением того же имени в Laravel и включает все базовые методы.

Для создания этого поля используйте статический метод `make()`.

```php
HasMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
```

-`$label` - метка, заголовок поля,
-`$relationName` - имя отношения,
-`$resource` - ресурс модели, на который ссылается отношение.

> [!CAUTION]
> Параметр `$formatted` не используется в поле `HasMany`!

> [!WARNING]
> Наличие ресурса модели, на который ссылается отношение, обязательно.
Ресурс также необходимо [зарегистрировать](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) в сервис-провайдере `MoonShineServiceProvider` в методе `menu()` или `resources()`. В противном случае будет ошибка 404.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', 'comments', resource: new CommentResource()) 
    ];
}
 
//...
```

![has_many](https://moonshine-laravel.com/screenshots/has_many.png)
![has_many_dark](https://moonshine-laravel.com/screenshots/has_many_dark.png)

> [!NOTE]
> Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label`.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource()) 
    ];
}
 
//...
```

> [!NOTE]
> Вы можете опустить `$resource`, если ресурс модели соответствует имени отношения.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', 'comments') 
    ];
}
 
//...
```

<a name="fields"></a> 
## Поля

Метод `fields()` позволяет установить поля, которые будут отображаться в *preview*.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->fields([
                BelongsTo::make('User'),
                Text::make('Text'),
            ]) 
    ];
}
 
//...
```

![has_many_fields](https://moonshine-laravel.com/screenshots/has_many_fields.png)
![has_many_fields_dark](https://moonshine-laravel.com/screenshots/has_many_fields_dark.png)

<a name="creatable"></a> 
## Создание объекта отношения

Метод `creatable()` позволяет создать новый объект отношения через модальное окно.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->creatable() 
    ];
}
 
//...
```

![has_many_creatable](https://moonshine-laravel.com/screenshots/has_many_creatable.png)
![has_many_creatable_dark](https://moonshine-laravel.com/screenshots/has_many_creatable_dark.png)

Вы можете настроить *кнопку* создания, передав параметр button в метод.

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            ) 
    ];
}
 
//...
```

<a name="limit"></a> 
## Количество записей

Метод `limit()` позволяет ограничить количество записей, отображаемых в *preview*.

```php
limit(int $limit)
```

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->limit(1) 
    ];
}
 
//...
```

<a name="only-link"></a> 
## Только ссылка

Метод `onlyLink()` позволит отобразить отношение в виде ссылки с количеством элементов.

```php
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
```

Вы можете передать в метод необязательные параметры:
- `linkRelation` - ссылка на отношение;
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink()
    ];
}

//...
```
![has_many_link](https://moonshine-laravel.com/screenshots/has_many_link.png)
![has_many_link_dark](https://moonshine-laravel.com/screenshots/has_many_link_dark.png)

#### linkRelation

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink('comment')
    ];
}

//...
```

#### condition

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            })
    ];
}

//...
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
> Рецепт: [сохранение файлов](https://moonshine-laravel.com/docs/resource/recipes/recipes#hasmany-parent-id) связей *HasMany* в директории с ID родителя.

<a name="change-edit-button"></a> 
## Кнопка редактирования

Метод `changeEditButton()` позволяет полностью переопределить кнопку редактирования.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
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
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
    ->withoutModals()
```

<a name="modify"></a> 
## Модификация

Поле *HasMany* имеет методы, которые можно использовать для модификации кнопок, изменения *TableBuilder* для предпросмотра и формы, а также изменения кнопки *onlyLink*.

#### modifyItemButtons()

Метод `modifyItemButtons()` позволяет изменить кнопки просмотра, редактирования, удаления и массового удаления.

```php
/**
 * @param  Closure(ActionButton $detail, ActionButton $edit, ActionButton $delete, ActionButton $massDelete, self $field): array  $callback
 */
modifyItemButtons(Closure $callback)
```

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyItemButtons(
                fn(ActionButton $detail, $edit, $delete, $massDelete, HasMany $ctx) => [$detail]
            )
    ];
}
```

#### modifyOnlyLinkButton()

Метод `modifyOnlyLinkButton()` позволяет изменить кнопку *onlyLink*.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink()
            ->modifyOnlyLinkButton(
                fn(ActionButton $button, bool $preview) => $button
                    ->when($preview, fn(ActionButton $btn) => $btn->primary())
                    ->unless($preview, fn(ActionButton $btn) => $btn->secondary())
            )
    ];
}
```

#### modifyCreateButton() / modifyEditButton()

Методы `modifyCreateButton()` и `modifyEditButton()` позволяют изменить кнопки создания и редактирования.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyCreateButton(
                fn(ActionButton $button) => $button->setLabel('Custom create button')
            )
            ->modifyEditButton(
                fn(ActionButton $button) => $button->setLabel('Custom edit button')
            )
            ->creatable(true)
    ];
}
```

#### modifyTable()

Метод `modifyTable()` позволяет изменить *TableBuilder* для предпросмотра и формы.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyTable(
                fn(TableBuilder $table, bool $preview) => $table
                    ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
                    ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
            )
    ];
}
```

<a name="advanced"></a> 
## Продвинутое использование

### Отношение через JSON поле
Поле *HasMany* по умолчанию отображается вне основной формы ресурса. Если вам нужно отобразить поля отношения внутри основной формы, то вы можете использовать поле *JSON* в режиме `asRelation()`. 

```php
//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource())
            //...
    ]
}

//...
```
> [!NOTE]
> Для более подробной информации обратитесь к разделу [Json поле](https://moonshine-laravel.com/docs/resource/fields/fields-json#relation).

#### Отношение через поле Template

Используя *поле Template*, вы можете построить поле для отношений *HasMany*, используя fluent интерфейс в процессе декларации.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле Template](https://moonshine-laravel.com/docs/resource/fields/fields-template).

#### Вкладки поля HasMany

В **Moonshine** вы можете настроить страницу формы и разместить поля *HasMany* во вкладках, используя декорации *Tabs* и *Tab*.

```php
class PostFormPage extends FormPage
{
    public function components(): array
    {
        if(! $this->getResource()->getItemID()) {
            return parent::components();
        }

        $bottomComponents = $this->getLayerComponents(Layer::BOTTOM);
        $imagesComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'images')->first();
        $commentsComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'comments')->first();

        $tabLayer = [
            Block::make('', [
                Tabs::make([
                    Tab::make('Редактировать', $this->mainLayer()),
                    Tab::make('Изображения', [$imagesComponent]),
                    Tab::make('Комментарии', [$commentsComponent])
                ])
            ])
        ];

        return [
            ...$this->getLayerComponents(Layer::TOP),
            ...$tabLayer,
        ];
    }
}
```

> [!NOTE]
> Для получения более подробной информации вы можете прочитать статью [Кастомизация страницы формы. Moon Shine 2.0](https://cutcode.dev/articles/kastomizaciia-stranicy-formy-moonshine-20).
