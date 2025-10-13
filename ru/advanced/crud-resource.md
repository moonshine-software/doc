# CrudResource

- [Основы](#basics)
- [Создание собственного ресурса](#custom-resource)
- [Пример REST-ресурса](#rest-example)
- [Полная кастомизация](#full-customization)

---

<a name="basics"></a>
## Основы

`CrudResource` является фундаментальной частью "**MoonShine** для **Laravel**".
Важно понимать, что ядро **MoonShine** не зависит от **Laravel** и тем более от моделей **Eloquent**.
Но в реализации для **Laravel** мы предоставляем готовый `ModelResource` для работы с моделями и соответствующие `type-casts`.
**MoonShine** очень гибкий и вы можете создать собственный ресурс для работы с любыми источниками данных.

`CrudResource` предоставляет базовую структуру для работы с данными, не привязываясь к конкретной реализации.
Это позволяет:

- работать с любыми источниками данных (базы данных, API, файлы и т.д.),
- создавать собственные реализации для специфических задач,
- использовать единый интерфейс независимо от источника данных.

<a name="custom-resource"></a>
## Создание собственного ресурса

Для создания собственного ресурса достаточно расширить `CrudResource` и реализовать абстрактные методы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Crud\Resources\CrudResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;

final class RestCrudResource extends CrudResource
{
    public function findItem(bool $orFail = false): ?DataWrapperContract
    {
        // ...
    }

    public function getItems(): iterable|Collection|LazyCollection|CursorPaginator|Paginator;
    {
        // ...
    }

    public function massDelete(array $ids): void
    {
        // ...
    }

    public function delete(DataWrapperContract $item, ?FieldsContract $fields = null): bool
    {
        // ...
    }

    public function save(DataWrapperContract $item, ?FieldsContract $fields = null): DataWrapperContract
    {
        // ...
    }
}
```

<a name="rest-example"></a>
## Пример REST-ресурса

Вот пример реализации ресурса для работы с `REST API`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use Illuminate\Support\Facades\Http;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Crud\Resources\CrudResource;

final class RestCrudResource extends CrudResource
{
    public function getItems(): iterable
    {
        yield from collect(Http::get('https://jsonplaceholder.typicode.com/todos')->json())
            ->map(fn ($item): DataWrapperContract => $this->getCaster()->cast($item))
            ->toArray();
    }
    public function findItem(bool $orFail = false): ?DataWrapperContract
    {
        return $this->getCaster()->cast(
            Http::get('https://jsonplaceholder.typicode.com/todos/' . $this->getItemID())->json()
        );
    }
    public function massDelete(array $ids): void
    {
        $this->beforeMassDeleting($ids);
        foreach ($ids as $id) {
            $this->delete($this->getCaster()->cast(['id' => $id]));
        }
        $this->afterMassDeleted($ids);
    }
    public function delete(DataWrapperContract $item, ?FieldsContract $fields = null): bool
    {
        return Http::delete('https://jsonplaceholder.typicode.com/todos/' . $item->getOriginal()['id'])->successful();
    }
    public function save(DataWrapperContract $item, ?FieldsContract $fields = null): DataWrapperContract
    {
        $originalItem = $item->getOriginal();
        $data = request()->all();
        if ($originalItem['id'] ?? false) {
            return Http::put('https://jsonplaceholder.typicode.com/todos/' . $originalItem['id'], $data)->json();
        }
        $this->isRecentlyCreated = true;
        return $this->getCaster()->cast(Http::post('https://jsonplaceholder.typicode.com/todos', $originalItem)->json());
    }
}
```

<a name="full-customization"></a>
# Полная кастомизация

Если вам требуется полный контроль над ресурсом, вместо наследования от `CrudResource`, вы можете реализовать интерфейс `CrudResourceContract`.
Это даст вам максимальную гибкость в реализации всех необходимых методов.
