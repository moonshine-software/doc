# Фильтры

Для создания фильтров также используются поля: они отображаются только на главной странице раздела.

Чтобы указать, по каким полям фильтровать данные, достаточно в вашем ресурсе модели в методе `filters()` вернуть массив с необходимыми полями.

> [!NOTE]
> Если метод отсутствует или возвращает пустой массив, то фильтры не будут отображаться.

> [!NOTE]
> Некоторые поля не могут участвовать в построении запроса фильтрации, поэтому они будут автоматически исключены из списка фильтров.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array
    {
        return [
            Text::make('Title', 'title'),
        ];
    }

    //...
}
```

![filters](https://moonshine-laravel.com/screenshots/filters.png)
![filters_dark](https://moonshine-laravel.com/screenshots/filters_dark.png)

> [!TIP]
> Поля являются ключевым элементом в построении форм в админ-панели **Moonshine**.
[Подробнее о полях](https://moonshine-laravel.com/docs/resource/fields/fields-index)

Если вам нужно кэшировать состояние фильтров, используйте свойство `saveFilterState` в ресурсе

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $saveFilterState = true;
//...
}
```
