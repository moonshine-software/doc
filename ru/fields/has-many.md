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
- [Активные действия](#active-actions)
- [Добавление ActionButtons](#add-action-buttons)
- [Отображение](#view)
- [Продвинутое использование](#advanced)

---

<a name="basics"></a>
## Основы

Поле `HasMany` предназначено для работы с одноименной связью в **Laravel** и включает все [Базовые методы](/docs/{{version}}/fields/basic-methods).

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
- `$resource` - `ModelResource`, на который ссылается отношение.

> [!WARNING]
> Параметр `$formatted` не используется в поле `HasMany`!

> [!WARNING]
> Наличие `ModelResource`, на который ссылается отношение, обязательно.
> Ресурс также необходимо [зарегистрировать](/docs/{{version}}/model-resource/index#declaring-in-the-system) в сервис-провайдере `MoonShineServiceProvider` в методе `$core->resources()`.
> В противном случае будет ошибка 500.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make(
    'Comments',
    'comments',
    resource: CommentResource::class
)
```

> [!WARNING]
> Поле BelongsTo, указывающее на родительскую запись, является обязательным.

![has_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many.png#light)
![has_many_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_dark.png#dark)

Вы можете опустить `$resource`, если `ModelResource` совпадает с названием связи.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments')
```

Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label` (по правилам camelCase).

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments')
```

По умолчанию поле отображается вне основной формы.
Если вы хотите изменить это поведение и отобразить его внутри основной формы, воспользуйтесь методом `disableOutside()`.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments')->disableOutside()
```

<a name="fields"></a>
## Поля

Метод `fields()` позволяет установить поля, которые будут отображаться в *preview*.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Text;

HasMany::make('Comments', resource: CommentResource::class)
    ->fields([
        BelongsTo::make('User'),
        Text::make('Text'),
    ])
```

![has_many_fields](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_fields.png#light)
![has_many_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_fields_dark.png#dark)

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
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->creatable()
```

> [!WARNING]
> Поле BelongsTo, указывающее на родительскую запись, является обязательным.
>
![has_many_creatable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_creatable.png#light)
![has_many_creatable_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_creatable_dark.png#dark)

Вы можете настроить *кнопку* создания, передав параметр button в метод.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

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
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->limit(1)
```

<a name="only-link"></a>
## Только ссылка

Метод `relatedLink()` позволит отобразить отношение в виде ссылки с количеством элементов.
Ссылка будет вести на IndexPage дочернего ресурса из отношения `HasMany`, в котором буду показаны только данные элементы.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

Вы можете передать в метод необязательные параметры:

- `linkRelation` - ссылка на отношение,
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

> [!NOTE]
> Не забудьте добавить отношение в свойство `$with` ресурса.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink()
```
![has_many_link](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_link.png#light)
![has_many_link_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_many_link_dark.png#dark)

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink('comment')
```

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Field;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink(condition: function (int $count, Field $field): bool {
        return $count > 10;
    })
```

<a name="parent-id"></a>
## ID родителя

Если у отношения есть ресурс, и вы хотите получить ID родительского элемента, то Вы можете использовать трейт `ResourceWithParent`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    // ...
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
> Рецепт: [сохранение файлов](/docs/{{version}}/recipes/hasmany-parent-id) связей `HasMany` в директории с ID родителя.

<a name="change-edit-button"></a>
## Кнопка редактирования

Метод `changeEditButton()` позволяет полностью переопределить кнопку редактирования.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->changeEditButton(
        ActionButton::make(
            'Edit',
            fn(Comment $comment) => app(CommentResource::class)->formPageUrl($comment)
        )
    )
```

<a name="without-modals"></a>
## Модальное окно

По умолчанию создание и редактирование записи поля `HasMany` происходит в модальном окне, метод `withoutModals()` позволяет отключить это поведение.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->withoutModals()
```

<a name="modify"></a>
## Модификация

Поле `HasMany` имеет методы, которые можно использовать для модификации кнопок, изменения `TableBuilder` для предпросмотра и формы, а также изменения кнопки *relatedLink*.

### searchable()

По умолчанию на странице формы для поля `HasMany` доступно поле поиска.
Чтобы его отключить, можно воспользоваться методом `searchable()`.

```php
public function searchable(Closure|bool|null $condition = null): static
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->searchable(false) // отключает поле поиска
```

### modifyItemButtons()

Метод `modifyItemButtons()` позволяет изменить кнопки просмотра, редактирования, удаления и массового удаления.

```php
/**
 * @param  Closure(ActionButtonContract $detail, ActionButtonContract $edit, ActionButtonContract $delete, ActionButtonContract $massDelete, static $ctx): array  $callback
 */
modifyItemButtons(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyItemButtons(
        fn(ActionButton $detail, $edit, $delete, $massDelete, HasMany $ctx) => [$detail]
    )
```

### modifyRelatedLink()

Метод `modifyRelatedLink()` позволяет изменить кнопку *relatedLink*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

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
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

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

Метод `modifyTable()` позволяет изменить `TableBuilder` для предпросмотра и формы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Table\TableBuilder;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table
            ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
            ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
    )
```

### Редирект после изменения

Метод `redirectAfter()` позволяет редирект после сохранения/добавления/удаления.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->redirectAfter(fn(int $parentId) => route('home'))
```

### Модификация QueryBuilder

Метод `modifyBuilder()` позволяет модифицировать запрос через *QueryBuilder*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use Illuminate\Database\Eloquent\Relations\Relation;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyBuilder(fn(Relation $query, HasMany $ctx) => $query)
```

<a name="active-actions"></a>
## Активные действия

Есть возможность быстро включать/выключать определенные действия в рамках `HasMany`.

Метод `activeActions()` явно задаёт список доступных действий.

```php
HasMany::make('Comments')
    ->activeActions(
        Action::VIEW,
        Action::UPDATE,
    )
```

Метод `withoutActions()` позволяет исключить отдельные действия.

```php
HasMany::make('Comments')
    ->withoutActions(
        Action::VIEW
    )
```

> [!WARNING]
> Политики и `activeActions` ресурса имеют приоритет. Если ресурс закрывает доступ, то `activeActions` поля доступ не предоставит.

<a name="add-action-buttons"></a>
## Добавление ActionButtons

### indexButtons()

Метод `indexButtons()` позволяет добавить дополнительные `ActionButtons` для работы с элементами `HasMany`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->indexButtons([
        ActionButton::make('Custom button')
    ])
```

### formButtons()

Метод `formButtons()` позволяет добавить дополнительные `ActionButtons` внутри формы при создании или редактировании элемента `HasMany`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->formButtons([
        ActionButton::make('Custom form button')
    ])
```

<a name="view"></a>
## Отображение

### Отображение внутри Tabs

Поля отношений в **MoonShine** по умолчанию отображаются внизу, отдельно от формы, и следуют друг за другом. Чтобы изменить отображение поля и добавить его в `Tabs`, можно использовать метод `tabMode()`.

```php
tabMode(Closure|bool|null $condition = null)
```

В следующем примере будет создан компонент [Tabs](/docs/{{version}}/components/tabs) с двумя вкладками Comments и Covers.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->tabMode(),
HasMany::make('Covers', 'covers', resource: CoverResource::class)
    ->tabMode()
```

> [!NOTE]
> tabMode не будет работать при использовании метода `disableOutside()`

### Отображение внутри модального окна

Для того чтобы HasMany поле было отображено в модальном окне, которое вызывается по кнопке, можно использовать режим `modalMode()`.

```php
public function modalMode(
    Closure|bool|null $condition = null,
    ?Closure $modifyButton = null,
    ?Closure $modifyModal = null
)
```

В данном примере вместо таблицы теперь будет [ActionButton](/docs/{{version}}/components/action-button), который вызывает [Modal](/docs/{{version}}/components/modal).

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->modalMode(),
```

Чтобы модифицировать `ActionButton` и `Modal`, можно воспользоваться параметрами метода `$modifyButton` и `$modifyModal`, в которые можно передать замыкание.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->modalMode(
        modifyButton: function (ActionButtonContract $button, HasMany $ctx) {
            $button->warning();
            return $button;
        },
        modifyModal: function (Modal $modal, ActionButtonContract $ctx) {
            $modal->autoClose(false);
            return $modal;
        }
    )
```

<a name="advanced"></a>
## Продвинутое использование

### Местоположение поля

Поле используется только внутри *CRUD*-страниц, так как получает ресурс и страницу из *URL*.
Однако вы можете использовать его и на других страницах, указав местоположение через метод `nowOn()`.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->creatable()
    ->nowOn(page: $resource->getFormPage(), resource: $resource, params: ['resourceItem' => $item->getKey()])
    ->fillCast($item, new ModelCaster(Article::class)),
```

### Отношение через RelationRepeater поле
Поле `HasMany` по умолчанию отображается вне основной формы ресурса.
Если вам нужно отобразить поля отношения внутри основной формы, то вы можете использовать поле `RelationRepeater`.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле RelationRepeater](/docs/{{version}}/fields/relation-repeater).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;

RelationRepeater::make('Characteristics', 'characteristics')
    ->fields([
        ID::make(),
        Text::make('Name', 'name'),
        Text::make('Value', 'value'),
    ])
```

### Отношение через поле Template

Используя поле `Template`, вы можете построить поле для отношений `HasMany`, используя fluent интерфейс в процессе декларации.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле Template](/docs/{{version}}/fields/template).
