# Soft deletes

First, prepare the model to enable [soft deletes](https://laravel.com/docs/eloquent#soft-deleting).

Next, we will override the `modifyItemQueryBuilder()` method in the resource to correctly get the "deleted" model.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;

protected function modifyItemQueryBuilder(
    Builder $builder
): Builder
{
    return $builder->withTrashed();
}
```

Then add all the necessary functionality to the index page class.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:9]
use App\Models\Article;
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
                fn(Article $model) => $model->trashed()
            ),

        ActionButton::make('Force delete')
            ->method(
                'forceDelete',
                events: [$this->getListEventName()]
            )
            ->canSee(
                fn(Article $model) => $model->trashed()
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
        fn(Article $model) => !$model->trashed()
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
