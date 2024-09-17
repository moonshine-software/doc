https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts?change-moonshine-locale=en

------

# TypeCasts

By default in MoonShine, fields operate on primitive types and do not know anything about models. This was done so that the system was not tied only to models, and the fields could, depending on the situation have access to both raw data and typed data.

TypeCast for models is already included in the MoonShine box, but if you need to work with another data type, you will need an object that implements the MoonShineDataCast interface.

```php
namespace MoonShine\Contracts;

interface MoonShineDataCast
{
    public function getClass(): string;

    public function hydrate(array $data): mixed;

    public function dehydrate(mixed $data): array;
}
```

Let's take a look at the TypeCast example for models.

```php
namespace MoonShine\TypeCasts;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\MoonShineDataCast;

final class ModelCast implements MoonShineDataCast
{
    public function __construct(
        protected string $class
    ) {
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function hydrate(array $data): mixed
    {
        return (new ($this->getClass())($data));
    }

    public function dehydrate(mixed $data): array
    {
        return $data->attributesToArray();
    }
}
```

Well, its application in FormBuilder/TableBuilder.

```php
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([
        Text::make('Email'),
    ])
    ->cast(ModelCast::make(User::class))
```

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make()
    ->fields([
        Text::make('Email'),
    ])
    ->fillCast(User::query()->first(), ModelCast::make(User::class))
```
