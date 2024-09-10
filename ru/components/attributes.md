# Атрибуты компонентов

- [Добавление](#set-attribute)
- [Удаление](#remove-attribute)
- [Итеративные атрибуты](#iterable-attributes)
- [Массовое изменение](#custom-attributes)
- [Объединение значений](#merge-attribute)
- [Добавление класса](#class)
- [Добавление стиля](#style)
- [Атрибуты для Alpine.js](#alpine)

___

Компоненты предлагают удобный механизм для управления HTML-классами, стилями и другими атрибутами,
что позволяет более гибко настраивать их поведение и внешний вид.

<a name="set-attribute"></a>
## [Добавление](#set-attribute)

Метод `setAttribute()` добавляет или изменить атрибут компонента.

```php
setAttribute(string $name, string|bool $value)
```

- `$name` - название атрибута,
- `$value` - значение.

```php
$component->setAttribute('data-id', '123');
```

<a name="remove-attribute"></a>
## [Удаление](#remove-attribute)

Метод `removeAttribute()` удаляет атрибут по его имени.

```php
removeAttribute(string $name)
```

- `$name` - название атрибута.

```php
$component->removeAttribute('data-id');
```

<a name="iterable-attributes"></a>
## [Итеративные атрибуты](#iterable-attributes)

Метод `iterableAttributes` добавляет атрибуты, необходимые для работы с итеративными компонентами.

```php
iterableAttributes(int $level = 0)
```
- `$level` - уровень вложенности.

<a name="custom-attributes"></a>
## [Массовое изменение](#custom-attributes)

Метод `customAttributes()` добавляет или заменяет несколько атрибутов компонента.

```php
customAttributes(array $attributes, bool $override = false)
```

- `$attributes` - массив добавляемых атрибутов,
- `$override` - ключ который позволяет перезаписать существующие атрибуты.

```php
$component->customAttributes(['data-role' => 'admin'], true);
```

<a name="mergea-ttribute"></a>
## [Объединение значений](#merge-attribute)

Метод `mergeAttribute()` объединяет значение атрибута с новым значением, используя указанный разделитель.

```php
mergeAttribute(string $name, string $value, string $separator = ' ')
```

- `$name` - название атрибута,
- `$value` - значение,
- `$separator` - разделитель.

```php
$component->mergeAttribute('class', 'new-class');
```

<a name="class"></a>
## [Добавление класса](#class)

Метод `class()` добавляет CSS-классы к атрибутам компонента.

```php
class(string|array $classes)
```
- `$classes` - классы которые необходимо добавить к компоненту.

```php
$component->class(['btn', 'btn-primary']);
```

<a name="style"></a>
## [Добавление стиля](#style)

Метод `style` добавляет CSS-стили к атрибутам компонента.

```php
style(string|array $styles)
```

```php
$component->style(['color' => 'red']);
```

<a name="alpine"></a>
## [Атрибуты для Alpine.js](#alpine)

Для удобной интеграции с JavaScript-фреймворком AlpineJs используются методы установки соответствующих атрибутов.

> [!TIP]
> За более подробной информацией обратитесь к разделу по [AlpineJs]((/docs/{{version}}/frontend/alpinejs))
