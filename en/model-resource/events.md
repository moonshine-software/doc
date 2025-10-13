# Events

Since **MoonShine** is based on the standard **Eloquent** methods for adding, editing, and deleting, you can easily utilize the standard [events](https://laravel.com/docs/eloquent#events) of **Laravel**.

However, there is also a need to specifically bind to events within the **MoonShine** resources!
To do this, you need to implement the required events in your resource.

```php
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;

protected function beforeCreating(DataWrapperContract $item): DataWrapperContract
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterCreated(DataWrapperContract $item): DataWrapperContract
{
    return $item;
}

protected function beforeUpdating(DataWrapperContract $item): DataWrapperContract
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterUpdated(DataWrapperContract $item): DataWrapperContract
{
    return $item;
}

protected function beforeDeleting(DataWrapperContract $item): DataWrapperContract
{
    return $item;
}

protected function afterDeleted(DataWrapperContract $item): DataWrapperContract
{
    return $item;
}

protected function beforeMassDeleting(array $ids): void
{
    // Logic goes here
}

protected function afterMassDeleted(array $ids): void
{
    // Logic goes here
}
```
