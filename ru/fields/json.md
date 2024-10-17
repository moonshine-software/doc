# Json
  - [Основы](#basics)
  - [Ключ/Значение](#key-value)
  - [С набором полей](#fields)
  - [Только значение](#value-only)
  - [Значение по умолчанию](#default)
  - [Добавление/Удаление](#creatable-removable)
  - [Вложенные значения](#nesting)
  - [Отношения через Json](#relation)
  - [Фильтр](#filter)
  - [Кнопки](#buttons)
  - [Модификация](#modify)

---

<a name="basics"></a>
## Основы
Поле *Json* включает все базовые методы.

*Json* имеет несколько методов для установки структуры поля:  
`keyValue()`, `onlyValue()` и `fields()`.

> [!NOTE]
> В базе данных поле должно быть текстового или json типа. Также требуется cast eloquent модели в массив, json или коллекцию.

<a name="key-value"></a>
## Ключ/Значение

Самый простой способ работы с полем *Json* - использовать метод `keyValue()`.
Результатом будет простой json `{key: value}`.

```php
keyValue(
    string $key = 'Key',
    string $value = 'Value'
)
```

```php
use MoonShine\Fields\Json; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data') 
            ->keyValue() 
    ];
}
 
//...
```

![json_key_value](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_key_value.png)
![json_key_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_key_value_dark.png)

По умолчанию ключи и значения являются полями *Text*, но вы можете использовать другие поля для примитивных данных.

```php
use MoonShine\Fields\Json; 
use MoonShine\Fields\Select;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Label', 'data')->keyValue(
            keyField: Select::make('Key')->options(['vk' => 'VK', 'email' => 'E-mail']),
            valueField: Select::make('Value')->options(['1' => '1', '2' => '2']),
        ), 
    ];
}
 
//...
```

<a name="fields"></a>
## С набором полей

Для более продвинутого использования используйте метод `fields()` и передайте необходимый набор полей.
В результате будет сгенерирован следующий json:  
`[{title: 'title', value: 'value', active: 'active'}]`

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Json; 
use MoonShine\Fields\Position; 
use MoonShine\Fields\Switcher; 
use MoonShine\Fields\Text; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Product Options', 'options') 
            ->fields([
                Position::make(),
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ]) 
    ];
}
 
//...
```

![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields.png)
![json_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields_dark.png)

<a name="value-only"></a>
## Только значение

Иногда вам нужно хранить в базе данных только значения. Для этого можно использовать метод `onlyValue()`. Результатом будет json `['value']`.

```php
onlyValue(string $value = 'Value')
```

```php
use MoonShine\Fields\Json; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data') 
            ->onlyValue() 
    ];
}
 
//...
```

![json_only_value](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_only_value.png)
![json_only_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_only_value_dark.png)

<a name="default"></a>
## Значение по умолчанию
Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue('Key', 'Value')
            ->default([
                [
                    'key' => 'Default key',
                    'value' => 'Default value'
                ]
            ]),

        Json::make('Product Options', 'options')
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ])
            ->default([
                [
                    'title' => 'Default title',
                    'value' => 'Default value',
                    'active' => true
                ]
            ]),

        Json::make('Values')
            ->onlyValue()
            ->default([
                ['value' => 'Default value']
            ])
    ];
}

//...
```

<a name="creatable-removable"></a>
## Добавление/Удаление

По умолчанию поле *Json* содержит только одну запись. Метод `creatable()` позволяет добавлять записи, а метод `removable()` позволяет удалять существующие.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButton $button = null
)
```

-`$condition` - условие выполнения метода,
-`$limit` - количество записей, которые можно добавить,
-`$button` - пользовательская кнопка добавления.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

-`$condition` - условие выполнения метода,
-`$attributes` - дополнительные атрибуты кнопки.

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(limit: 6) 
            ->removable() 
    ];
}
 
//...
```

![json_removable](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_removable.png)
![json_removable_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_removable_dark.png)

#### Пользовательская кнопка добавления

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(
                button: ActionButton::make('New', '#')->primary()
            ) 
    ];
}
 
//...
```

#### Атрибуты для кнопки удаления

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])
            ->removable(attributes: ['@click.prevent' => 'customAsyncRemove']) 
            ->creatable()
    ];
}
 
//...
```

<a name="nesting"></a>
## Вложенные значения

Вы можете получить вложенные значения полей *JSON*, используя `.`.
Значения можно редактировать, но изменения не затронут другие ключи.

 ```php
 {"info": [{"title": "Info title", "value": "Info value"}], "content": [{"title": "Content title", "value": "Content value"}]}
 ```
 
 ```php
 use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
            ])->removable()
    ];
}

//...
 ```

<a name="vertical"></a>
## Вертикальное отображение

Метод `vertical()` позволяет изменить горизонтальное расположение полей на вертикальное.

```php
vertical()
```

```php
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->vertical()
    ];
}

//...
```
![json_vertical](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_vertical.png)
![json_vertical_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_vertical_dark.png)

<a name="relation"></a>
## Отношения через Json

Поле *Json* может работать с отношениями; для этого используется метод `asRelation()`, которому нужно присвоить *ModelResource* отношений и указать массив редактируемых полей.

```php
asRelation(ModelResource $resource)
```

```php
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource())
            ->fields([
                ID::make(),
                BelongsTo::make('Article')
                    ->setColumn('article_id')
                    ->searchable(),
                BelongsTo::make('User')
                    ->setColumn('user_id'),
                Text::make('Text')->required(),
            ])
            ->creatable()
            ->removable()
    ];
}
//...
```
> [!WARNING]
> Для отношений наличие поля ID в методе fields обязательно!

> [!WARNING]
> При использовании *BelongsTo* необходимо использовать метод `setColumn()`, чтобы установить поле в таблице базы данных!

![json_relation](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_relation.png)
![json_relation_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_relation_dark.png)

<a name="filter"></a>
## Фильтр

Если поле используется для построения фильтра, то необходимо использовать метод `filterMode()`. Этот метод адаптирует поведение поля и устанавливает `creatable = false`.

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

//...

public function filters(): array
{
    return [
        Json::make('Data')
            ->fields([
                Text::make('Title', 'title'),
                Text::make('Value', 'value')
            ])
            ->filterMode()
    ];
}

//...
```

<a name="buttons"></a>
## Кнопки

Метод `buttons()` позволяет добавить дополнительные кнопки к полю *Json*.

```php
buttons(array $buttons)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])->buttons([
            ActionButton::make('', '#')
                ->icon('heroicons.outline.trash')
                ->onClick(fn() => 'remove()', 'prevent')
                ->customAttributes(['class' => 'btn-secondary'])
                ->showInLine()
        ])
    ];
}

//...
```

<a name="#modify"></a>
## Модификация

Поле *Json* имеет методы, с помощью которых можно модифицировать кнопку удаления или изменить *TableBuilder* для предпросмотра и формы.

#### modifyRemoveButton()

Метод `modifyRemoveButton()` позволяет изменить кнопку удаления.

```php
/**
 * @param  Closure(ActionButton $button, self $field): ActionButton  $callback
 */
modifyRemoveButton(Closure $callback)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->modifyRemoveButton(
                fn(ActionButton $button) => $button->customAttributes([
                    'class' => 'btn-secondary'
                ])
            )
    ];
}

//...
```

#### modifyTable()

Метод `modifyTable()` позволяет изменить *TableBuilder* для предпросмотра и формы.

```php
/**
 * @param  Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

```php
use MoonShine\Components\TableBuilder;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->modifyTable(
                fn(TableBuilder $table, bool $preview) => $table->customAttributes([
                    'style' => 'width: 50%;'
                ])
            )
    ];
}

//...
```

