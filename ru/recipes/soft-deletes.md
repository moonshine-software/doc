# Soft deletes

В модели нужно подключить Laravel трейт `SoftDeletes`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    // ...
}
```

Далее добавим необходимый функционал в ресурс.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\ActionButton;

class ArticleResource extends ModelResource
{
    // ...

    protected function indexButtons(): ListOf
    {
        return parent::indexButtons()
            ->prepend(
                ActionButton::make('Restore')
                    ->method('restore', events: [$this->getListEventName()])
                    ->canSee(fn(Article $model) => $model->trashed()),
                ActionButton::make('Force delete')
                    ->method('forceDelete', events: [$this->getListEventName()])
                    ->canSee(fn(Article $model) => $model->trashed()),
            );
    }

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                'Deleted',
                static fn(Builder $q) => $q->onlyTrashed()
            )
        ];
    }

    protected function modifyItemQueryBuilder(Builder $builder): Builder
    {
        return $builder->withTrashed();
    }

    public function restore(
        MoonShineRequest $request
    ): MoonShineJsonResponse
    {
        $item = $request->getResource()->getItem();
        $item->restore();

        return MoonShineJsonResponse::make()
            ->toast('Success');
    }

    public function forceDelete(
        MoonShineRequest $request
    ): MoonShineJsonResponse
    {
        $item = $request->getResource()->getItem();
        $item->forceDelete();

        return MoonShineJsonResponse::make()
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
}
```
