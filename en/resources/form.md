# Form

  - [Validation](#validation)
  - [Messages](#messages)
  - [Preparing input data for verification](#prepare)
  - [Buttons](#buttons)
  - [Asynchronous mode](#async)

---

<a name="validation"></a>
## Validation

Validation is as easy as in the `FormRequests` classes from Laravel.

It is enough to add rules in the model resource `rules()` method in the usual manner.

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

![validation](https://moonshine-laravel.com/screenshots/validation.png)
![validation_dark](https://moonshine-laravel.com/screenshots/validation_dark.png)

<a name="messages"></a>
## Messages

Using the `validationMessages()` method you can create your own validation error messages.

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
            'email.required' => 'Required email'
        ];
    }

    //...
}
```

<a name="prepare"></a>
## Preparing input data for verification

If you need to prepare or clean up any data from the request before applying your validation rules, you can use the `prepareForValidation()` method.


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
## Buttons

To add buttons, use ActionButton and the `FormButtons` or `buttons` methods in the resource.

> [!NOTE]
> More details ActionButton

```php
public function formButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
```

You can also use the `buttons` method, but in this case, the buttons will be on the resource all other pages.

```php
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
```

<a name="async"></a>
## Asynchronous mode

Switch mode without reboot to save data.

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

Switch form mode to Precognitive validation.

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
