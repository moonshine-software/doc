@php use MoonShine\Fields\Text; @endphp
<x-page
    title="TypeCasts"
>

<x-p>
    By default in MoonShine, fields operate on primitive types and do not know anything about models.
    This was done so that the system was not tied only to models, and the fields could, depending on the situation
    have access to both raw data and typed data
</x-p>

<x-p>
    TypeCast for models is already included in the MoonShine box, but if you need
    work with another data type, you will need an object that implements the MoonShineDataCast interface
</x-p>

<x-code>
namespace MoonShine\Contracts;

interface MoonShineDataCast
{
    public function getClass(): string;

    public function hydrate(array $data): mixed;

    public function dehydrate(mixed $data): array;
}
</x-code>

<x-p>
    Let's take a look at the TypeCast example for models
</x-p>

<x-code>
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
</x-code>

<x-p>
    Well, its application in FormBuilder/TableBuilder
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([
        Text::make('Email'),
    ])
    ->cast(ModelCast::make(User::class))
</x-code>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make()
    ->fields([
        Text::make('Email'),
    ])
    ->fillCast(User::query()->first(), ModelCast::make(User::class))
</x-code>

</x-page>