# События

Поскольку MoonShine работает, используя стандартные методы eloquent для добавления, редактирования и удаления, очень просто использовать стандартные события Laravel: [события](https://laravel.com/docs/eloquent#events)

Однако также важно связаться с событиями внутри ресурсов MoonShine.
Для этого необходимо включить необходимые события в ресурс.

```php
protected function beforeCreating(Model $item): Model
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterCreated(Model $item): Model
{
    return $item;
}

protected function beforeUpdating(Model $item): Model
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterUpdated(Model $item): Model
{
    return $item;
}

protected function beforeDeleting(Model $item): Model
{
    return $item;
}

protected function afterDeleted(Model $item): Model
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

public function beforeImportFilling(array $data): array
{
    return $data;
}

public function beforeImported(Model $item): Model
{
    return $item;
}

public function afterImported(Model $item): Model
{
    return $item;
}
```
