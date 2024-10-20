# События

Так как `MoonShine` работает на основе стандартных `Eloquent` методов по добавлению, редактированию и удалению, то вы можете легко использовать стандартные `Laravel` [события](https://laravel.com/docs/eloquent#events) `Laravel`:

Но также возникает потребность привязаться именно к событиям в рамках ресурсов `MoonShine`! Для этого в ресурсе необходимо реализовать нужные Вам события

```php
protected function beforeCreating(mixed $item): mixed
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterCreated(mixed $item): mixed
{
    return $item;
}

protected function beforeUpdating(mixed $item): mixed
{
    if (auth()->user()->moonshine_user_role_id !== 1) {
        request()->merge([
            'author_id' => auth()->id(),
        ]);
    }

    return $item;
}

protected function afterUpdated(mixed $item): mixed
{
    return $item;
}

protected function beforeDeleting(mixed $item): mixed
{
    return $item;
}

protected function afterDeleted(mixed $item): mixed
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
