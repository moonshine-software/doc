# Правила валидации

   - [Основы](#basics)
   - [Отображение ошибок валидации](#errors)
   - [Сообщения](#messages)
   - [Подготовка входных данных для валидации](#prepare)

---

<a name="basics"></a>
## Основы

Валидация так же проста, как и в классах `FormRequests`, предоставляемых Laravel.

Вы можете просто добавить правила в метод `rules()` ресурса обычным способом.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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

<a name="errors"></a>
## Отображение ошибок валидации

За отображение ошибок валидации в верхней части формы отвечает параметр ресурса `$errorsAbove`. По умолчанию значение `true`, что означает, что ошибки валидации будут отображаться.

![errors_above_true](https://moonshine-laravel.com/screenshots/errors_above_true.png)

Чтобы скрыть ошибки валидации в верхней части формы, установите параметр ресурса `$errorsAbove` в значение `false`.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...
    protected bool $errorsAbove = false;
    //...
}
```

![errors_above_false](https://moonshine-laravel.com/screenshots/errors_above_false.png)

<a name="messages"></a>
## Сообщения

Используя метод `validationMessages()`, вы можете создавать свои собственные сообщения об ошибках валидации.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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
## Подготовка входных данных для валидации

Если вам нужно подготовить или очистить какие-либо данные из запроса перед применением правил валидации, вы можете использовать метод `prepareForValidation()`.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function prepareForValidation(): void
    {
        request()?->merge([
            'email' => request()
                ?->string('email')
                ->lower()
                ->value()
        ]);
    }

    //...
}
```
