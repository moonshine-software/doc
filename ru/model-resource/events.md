# События

Так как **MoonShine** работает на основе стандартных **Eloquent** методов по добавлению, редактированию и удалению, то вы можете легко использовать стандартные [события](https://laravel.com/docs/eloquent#events) **Laravel**.

Но также возникает потребность привязаться именно к событиям в рамках ресурсов **MoonShine**!
Для этого в ресурсе необходимо реализовать нужные Вам события.

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
    // Логика здесь
}

protected function afterMassDeleted(array $ids): void
{
    // Логика здесь
}
```
