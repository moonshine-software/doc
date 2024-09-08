# Оглавление
- [Описание](#description)
- [showWhen](#showwhen)
- [showWhenDate](#showwhendate)
- [Вложенные поля](#nested-fields)
- [Множественные условия](#multiple-conditions)
- [Поддерживаемые операторы](#supported-operators)
---

## [Описание](#description)

Для изменения отображения полей в зависимости от значений других полей в реальном времени, без перезагрузки страницы и запросов к серверу, используются методы `showWhen` и `showWhenDate`.

<a name="showwhen"></a>
## [Метод showWhen](#showwhen)

Метод `showWhen` позволяет задать условие отображения поля в зависимости от значения другого поля.

```php
public function showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
): static
```


### Параметры

- `$column` - имя поля, от которого зависит отображение,
- `$operator` - оператор сравнения (необязательный),
- `$value` - значение для сравнения.

### Пример использования

```php
Text::make('Name')
    ->showWhen('category_id', 1)
```


В этом примере поле "Name" будет отображаться только если значение поля "category_id" равно 1.

> [!NOTE]
> Если в функции `showWhen` передается только два параметра, то по умолчанию используется оператор `'='`.

```php
Text::make('Name')
    ->showWhen('category_id', 'in', [1, 2, 3])
```

В этом примере поле "Name" будет отображаться только если значение поля "category_id" равно 1, 2 или 3.

<a name="showwhendate"></a>
## [Метод showWhenDate](#showwhendate)

Метод `showWhenDate` позволяет задать условие отображения поля в зависимости от значения поля типа `date`. Логика для работы с датами была вынесена в отдельный метод из за специфики конвертации и сравнения типа `date` и `datetime` на backend и frontent

```php
public function showWhenDate(
    string $column,
    mixed $operator = null,
    mixed $value = null
): static
```


### Параметры

- `$column` - имя поля с датой, от которого зависит отображение,
- `$operator` - оператор сравнения (необязательный),
- `$value` - значение даты для сравнения.

### Пример использования

```php
Text::make('Content')
    ->showWhenDate('created_at', '>', '2024-09-15 10:00')
```

В этом примере поле "Content" будет отображаться только если значение поля "created_at" больше '2024-09-15 10:00'.

> [!NOTE]
> Если в функции `showWhenDate` передается только два параметра, то по умолчанию используется оператор `'='`.

> [!NOTE]
> Вы можете использовать любой формат даты, который может быть распознан функцией `strtotime()`.


<a name="nested-fields"></a>
## [Вложенные поля](#nested-fields)

Методы `showWhen` и `showWhenDate` поддерживают работу с вложенными полями, например для работы с полем `Json`. Для обращения к вложенным полям используется точечная нотация.

### Пример использования

```php
Text::make('Parts')
    ->showWhen('attributes.1.size', '!=', 2)
```

В этом примере поле "Parts" будет отображаться только если значение вложенного поля "size" во втором элементе массива "attributes" не равно 2.

showWhen работает и для вложенных полей типа `Json`:

```php
Json::make('Attributes', 'attributes')->fields([
    Text::make('Size'),
    Text::make('Parts')
        ->showWhen('category_id', 3)
    ,
    Json::make('Settings', 'settings')->fields([
        Text::make('Width')
            ->showWhen('category_id', 3)
        ,
        Text::make('Height'),
    ])
]),
```
В данном примере весь столбец `Parts` внтури `attributes` и весь столбец `Width` внтури `attributes.[n].settings` будет отображаться только если значение поля `category_id` равно 3.

<a name="multiple-conditions"></a>
## [Множественные условия](#multiple-conditions)

Методы `showWhen` и `showWhenDate` могут быть вызваны несколько раз для одного поля, что позволяет задать несколько условий отображения.

### Пример использования

```php
BelongsTo::make('Category', 'category', , resource: CategoryResource::class)
    ->showWhenDate('created_at', '>', '2024-08-05 10:00')
    ->showWhenDate('created_at', '<', '2024-08-05 19:00')
```


В этом примере поле "Category" будет отображаться только если значение поля "created_at" находится в диапазоне между '2024-08-05 10:00' и '2024-08-05 19:00'.

> [!NOTE]
> При использовании нескольких условий они объединяются логическим "И" (AND). Поле будет отображаться только если выполняются все заданные условия.

<a name="supported-operators"></a>
## [Поддерживаемые операторы](#supported-operators)

- `=`
- `!=`
- `>`
- `<`
- `>=`
- `<=`
- `in`
- `not in`

> [!NOTE]
> Оператор `in` проверяет, содержится ли значение в массиве.
> Оператор `not in` проверяет, не содержится ли значение в массиве.
