# CrudResource

- [Basics](#basics)
- [Creating a Custom Resource](#custom-resource)
- [REST Resource Example](#rest-example)
- [Full Customization](#full-customization)

---

<a name="basics"></a>
## Basics

`CrudResource` is a fundamental part of "**MoonShine** for **Laravel**".
It is important to understand that the core of **MoonShine** does not depend on **Laravel** and even more so on **Eloquent** models.
However, in the implementation for **Laravel**, we provide a ready-made `ModelResource` for working with models and corresponding `type-casts`.
**MoonShine** is very flexible, and you can create your own resource to work with any data sources.

`CrudResource` provides a basic structure for working with data without being tied to a specific implementation.
This allows:

- working with any data sources (databases, API, files, etc.),
- creating your own implementations for specific tasks,
- using a single interface regardless of the data source.

<a name="custom-resource"></a>
## Creating a Custom Resource

To create a custom resource, it is enough to extend `CrudResource` and implement the abstract methods.

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
## REST Resource Example

Here is an example of implementing a resource for working with a `REST API`:

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
# Full Customization

If you require complete control over the resource, instead of inheriting from `CrudResource`, you can implement the interface `CrudResourceContract`.
This will give you maximum flexibility in implementing all necessary methods.
