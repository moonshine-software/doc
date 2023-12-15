<x-page title="Events">

<x-p>
    Since MoonShine operates using standard eloquent methods for adding, editing, and deleting, it is effortless to utilise standard Laravel events:
    <x-link link="https://laravel.com/docs/eloquent#events">events</x-link>
</x-p>
<x-p>
    However, it is also essential to connect with the events within the MoonShine resources.
    To achieve this, you must incorporate the necessary events into the resource.
</x-p>

<x-code language="php">
protected function beforeCreating(Model $item): Model
{
    return $item;
}

protected function afterCreated(Model $item): Model
{
    return $item;
}

protected function beforeUpdating(Model $item): Model
{
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

protected function beforeForceDeleting(Model $item): Model
{
    return $item;
}

protected function afterForceDeleted(Model $item): Model
{
    return $item;
}

protected function beforeRestoring(Model $item): Model
{
    return $item;
}

protected function afterRestored(Model $item): Model
{
    return $item;
}
</x-code>

</x-page>
