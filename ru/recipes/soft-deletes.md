# Soft deletes

Сначала подготовьте модель для включения [soft deletes](https://laravel.com/docs/eloquent#soft-deleting).

Далее переопределим метод `modifyItemQueryBuilder()` в ресурсе для корректного получения "удаленной" модули.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;

protected function modifyItemQueryBuilder(
    Builder $builder
): Builder
{
    return $builder->withTrashed();
}
```

Затем добавим весь необходимый функционал в класс индексной страницы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:8]
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function queryTags(): array
{
    return [
        QueryTag::make(
            'Deleted',
            static fn(Builder $q) => $q->onlyTrashed()
        )
    ];
}

protected function buttons(): ListOf
{
    return parent::buttons()->prepend(
        ActionButton::make('Restore')
            ->method(
                'restore',
                events: [$this->getListEventName()]
            )
            ->canSee(
                fn(Car $model) => $model->trashed()
            ),

        ActionButton::make('Force delete')
            ->method(
                'forceDelete',
                events: [$this->getListEventName()]
            )
            ->canSee(
                fn(Car $model) => $model->trashed()
            ),
    );
}

#[AsyncMethod]
public function restore(
    CrudRequestContract $request
): JsonResponse
{
    $item = $request->getResource()->getItem();
    $item->restore();

    return JsonResponse::make()
        ->toast('Success');
}

#[AsyncMethod]
public function forceDelete(
    CrudRequestContract $request
): JsonResponse
{
    $item = $request->getResource()->getItem();
    $item->forceDelete();

    return JsonResponse::make()
        ->toast('Success');
}

protected function modifyDeleteButton(
    ActionButtonContract $button
): ActionButtonContract
{
    return $button->canSee(
        fn(Car $model) => !$model->trashed()
    );
}

protected function modifyMassDeleteButton(
    ActionButtonContract $button
): ActionButtonContract
{
    return $button->canSee(
        fn() => request()->input('query-tag') !== 'deleted'
    );
}
```
