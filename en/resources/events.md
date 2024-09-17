https://moonshine-laravel.com/docs/resource/models-resources/resources-events?change-moonshine-locale=en

------

## Events

Since MoonShine operates using standard eloquent methods for adding, editing, and deleting, it is effortless to utilise standard Laravel events:[events](https://laravel.com/docs/eloquent#events)  

However, it is also essential to connect with the events within the MoonShine resources.  
To achieve this, you must incorporate the necessary events into the resource.

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
    // Logic here
}

protected function afterMassDeleted(array $ids): void
{
    // Logic here
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
