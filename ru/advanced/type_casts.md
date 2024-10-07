# TypeCasts

По умолчанию в MoonShine поля работают с примитивными типами и ничего не знают о моделях. Это было сделано для того, чтобы система не была привязана только к моделям, и поля могли, в зависимости от ситуации, иметь доступ как к необработанным данным, так и к типизированным данным.

TypeCast для моделей уже включен в MoonShine, но если вам нужно работать с другим типом данных, вам понадобится объект, реализующий интерфейс MoonShineDataCast.

```php
namespace MoonShine\Contracts;

interface MoonShineDataCast
{
    public function getClass(): string;

    public function hydrate(array $data): mixed;

    public function dehydrate(mixed $data): array;
}
```

Давайте рассмотрим пример TypeCast для моделей.

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

Теперь рассмотрим его применение в FormBuilder/TableBuilder.

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
