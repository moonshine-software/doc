# Checkbox

- [Создание](#make)
- [On/off values](#on-off)
- [Редактирование в режиме предпросмотра](#editing-in-preview)

---

<a name="make"></a>
## Создание
Поле *Checkbox* включает все базовые методы.

```php
use MoonShine\Fields\Checkbox; 
 
//...
 
public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish') 
    ];
}
 
//...
```
 
<a name="on-off"></a>
## On/off values

По умолчанию поле имеет значения `1` и `0` для выбранного и невыбранного состояний соответственно. Методы `onValue()` и `offValue()` позволяют переопределить эти значения.

```php
onValue(int|string $onValue)
```

```php
offValue(int|string $onValue)
```

```php
use MoonShine\Fields\Checkbox;
 
//...
 
public function fields(): array
{
    return [
        Checkbox::make('Publish', 'is_publish')
            ->onValue('yes')
            ->offValue('no')
    ];
}
 
//...

```

<a name="editing-in-preview"></a>
## Редактирование в режиме предпросмотра
Метод `updateOnPreview()` позволяет редактировать поле *Checkbox* в режиме *предпросмотра*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```
-`$url` - URL для обработки асинхронного запроса,
-`$resource` - ресурс модели, на который ссылается отношение,
-`$condition` - условие выполнения метода.

> [!TIP]
> Настройки не обязательны и должны быть переданы, если поле работает вне ресурса.

```php
use MoonShine\Fields\Checkbox;

//...

public function fields(): array
{
    return [
        Checkbox::make(Public)
            ->updateOnPreview()
    ];
}

//...
```
