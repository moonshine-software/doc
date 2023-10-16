@php use MoonShine\Fields\Text; @endphp
<x-page
    title="TypeCasts"
>

<x-p>
    По умолчанию в MoonShine поля работают на основе примитивных типов и ничего не знают о моделях.
    Сделано это, чтобы система не была привязана только к моделям, а поля могли в зависимости от ситуации
    иметь доступ и к сырым данным и приведенным к типу
</x-p>

<x-p>
    TypeCast для моделей уже есть в коробке MoonShine, но если вам необходимо
    работать с другим типом данных, то потребуется объект реализующий интерфейс MoonShineDataCast
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
    Давайте взглянем на пример TypeCast для моделей
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
    Ну и его применение в FormBuilder/TableBuilder
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
