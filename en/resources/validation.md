https://moonshine-laravel.com/docs/resource/models-resources/resources-validation?change-moonshine-locale=en

------

# Validation rules

   - [Basics](#basics)
   - [Displaying validation errors](#errors)
   - [Messages](#messages)
   - [Preparing Input For Validation](#prepare)

<a name="basics"></a>
## Basics

Validation is as simple as in the `FormRequests` classes provided by Laravel.

You can simply add rules to the `rules()` method of the resource in the usual way.

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
![validation] (https://moonshine-laravel.com/screenshots/validation.png)

<a name="errors"></a>
## Displaying validation errors

The `$errorsAbove` resource parameter is responsible for displaying validation errors at the top of the form. The default value is `true`, which means that validation errors will be displayed.

![errors_above_true] (https://moonshine-laravel.com/screenshots/errors_above_true.png)

To hide validation errors at the top of the form, set the `$errorsAbove` resource parameter to `false`.

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

![errors_above_false] (https://moonshine-laravel.com/screenshots/errors_above_false.png)

<a name="messages"></a>
## Messages

Using the `validationMessages()` method, you can create your own validation error messages.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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
## Preparing Input For Validation

If you need to prepare or sanitize any data from the request before you apply your validation rules, you may use the `prepareForValidation()` method.

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
