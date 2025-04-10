# Фильтры

- [Основы](#basics)
- [Apply](#apply)
- [Кеширование состояния](#cache-state)

---

<a name="basics"></a>
## Основы

Для создания фильтров также используются [поля](/docs/{{version}}/fields/index).
Фильтры отображаются только на главной странице раздела.

Чтобы указать, по каким полям фильтровать данные, достаточно в вашем `ModelResource` в методе `filters()` вернуть массив с необходимыми полями.

> [!NOTE]
> Если метод отсутствует или возвращает пустой массив, то фильтры не будут отображаться.

> [!NOTE]
> Некоторые поля не могут участвовать в построении запроса фильтрации, поэтому они будут автоматически исключены из списка фильтров.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function filters(): iterable
    {
        return [
            Text::make('Title', 'title'),
        ];
    }
}
```

![filters](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/filters.png#light)
![filters_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/filters_dark.png#dark)

> [!NOTE]
> Поля являются ключевым элементом в построении форм **Moonshine**.
[Подробнее о полях](/docs/{{version}}/fields/index).

<a name="apply"></a>
## Apply

Для переопределения логики фильтрации вы можете применять метод полей [onApply()](/docs/{{version}}/fields/basic-methods#apply).
Так же предлагаем рассмотреть [процесс применения полей](/docs/{{version}}/fields/index#apply) на примере фильтрации.

<a name="cache-state"></a>
## Кеширование состояния

Если вам нужно кэшировать состояние фильтров, используйте свойство `$saveQueryState` в ресурсе.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $saveQueryState = true;

    // ...
}
```
