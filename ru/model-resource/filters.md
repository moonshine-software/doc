# Фильтры

Для создания фильтров также используются [поля](/docs/{{version}}/fields/index): они отображаются только на главной странице раздела.

Чтобы указать, по каким полям фильтровать данные, достаточно в вашем ресурсе модели в методе `filters()` вернуть массив с необходимыми полями.

> [!NOTE]
> Если метод отсутствует или возвращает пустой массив, то фильтры не будут отображаться.

> [!NOTE]
> Некоторые поля не могут участвовать в построении запроса фильтрации, поэтому они будут автоматически исключены из списка фильтров.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    protected function filters(): iterable
    {
        return [
            Text::make('Title', 'title'),
        ];
    }

    //...
}
```

![filters](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/filters.png)
![filters_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/filters_dark.png)

> [!TIP]
> Поля являются ключевым элементом в построении форм в админ-панели `Moonshine`.
[Подробнее о полях](/docs/{{version}}/fields/index)

Если вам нужно кэшировать состояние фильтров, используйте свойство `saveQueryState` в ресурсе

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $saveQueryState = true;
//...
}
```
