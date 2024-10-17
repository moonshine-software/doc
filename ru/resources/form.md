# Форма

  - [Валидация](#validation)
  - [Сообщения](#messages)
  - [Подготовка входных данных для проверки](#prepare)
  - [Кнопки](#buttons)
  - [Асинхронный режим](#async)

---

<a name="validation"></a>
## Валидация

Валидация так же проста, как и в классах `FormRequests` из Laravel.

Достаточно добавить правила в метод `rules()` ресурса модели обычным способом.

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

    public function rules($item): array
    {
        return [
            'title' => ['required', 'string', 'min:5']
        ];
    }

    //...
}
```

![validation](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/validation.png)
![validation_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/validation_dark.png)

<a name="messages"></a>
## Сообщения

Используя метод `validationMessages()`, вы можете создать свои собственные сообщения об ошибках валидации.

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

    public function validationMessages(): array
    {
        return [
            'email.required' => 'Требуется email'
        ];
    }

    //...
}
```

<a name="prepare"></a>
## Подготовка входных данных для проверки

Если вам нужно подготовить или очистить какие-либо данные из запроса перед применением правил валидации, вы можете использовать метод `prepareForValidation()`.

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

    public function prepareForValidation(): void
    {
        moonshineRequest()?->merge([
            'email' => request()
                ?->string('email')
                ->lower()
                ->value()
        ]);
    }

    //...
}
```

<a name="buttons"></a>
## Кнопки

Для добавления кнопок используйте ActionButton и методы `FormButtons` или `buttons` в ресурсе.

> [!NOTE]
> Подробнее о ActionButton

```php
public function formButtons(): array
{
    return [
        ActionButton::make('Ссылка', '/endpoint'),
    ];
}
```

Вы также можете использовать метод `buttons`, но в этом случае кнопки будут на всех остальных страницах ресурса.

```php
public function buttons(): array
{
    return [
        ActionButton::make('Ссылка', '/endpoint'),
    ];
}
```

<a name="async"></a>
## Асинхронный режим

Переключите режим без перезагрузки для сохранения данных.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    // ...
}
```

Переключите режим формы на предварительную валидацию (Precognitive validation).

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isPrecognitive = true;

    // ...
}
```
