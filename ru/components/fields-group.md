# FieldsGroup

- [Основы](#basics)
- [Наполнение данными](#fill)
- [Режим preview](#preview)
- [Режим без обверток](#without-wrappers)
- [Массовое изменение полей](#map)

---

<a name="basics"></a>
## Основы

Компонент `FieldsGroup` создан для быстрой группировки набора полей, наполнения их данными и смены их состояний.

```php
make(iterable $components = [])
```

`$components` - набор `FieldContract`.

```php
use MoonShine\UI\Components\FieldsGroup;

FieldsGroup::make([
    Text::make('Title'),
    Email::make('Email'),
]);
```

<a name="fill"></a>
## Наполнение данными

Чтобы наполнить все поля данными, воспользуйтесь методом `fill()`.

```php
fill(
    array $raw = [],
    ?DataWrapperContract $casted = null,
    int $index = 0,
)
```

```php
FieldsGroup::make($fields)
    ->fill($data)
```

<a name="preview"></a>
## Режим preview

Вы можете переключить все поля в наборе в режим "preview" с помощью метода `previewMode()`.

```php
FieldsGroup::make($fields)
    ->previewMode()
```

<a name="without-wrappers"></a>
## Режим без обверток

Вы можете переключить все поля в наборе в режим без обверток с помощью метода `withoutWrappers()`.

> [!NOTE]
> Обвертки - поля которые реализуют интерфейс `FieldsWrapperContract`, например `StackFields`.
> Тем самым при использовании метода `withoutWrappers` из поля-обвертки будут извлечены все вложенные поля,
> а само поле-обвертка не будет участвовать в итоговом наборе.

```php
FieldsGroup::make($fields)
    ->withoutWrappers()
```

<a name="map"></a>
## Массовое изменение полей

Все выше описанные методы под капотом используют метод `mapFields()`, который позволяет пройтись по всем элементам набора и изменить их состояние.

```php
FieldsGroup::make($fields)
    ->mapFields(
        fn(FieldContract $field, int $index): FieldContract => $field
    )
```
