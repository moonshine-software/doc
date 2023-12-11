<x-page title="Events">

<x-p>
    Since MoonShine works based on standard eloquent methods for adding, editing and deleting, you can easily use standard Laravel events:
    <x-link link="https://laravel.com/docs/eloquent#events">events</x-link>
</x-p>
<x-p>
    But there is also a need to become attached specifically to events within the MoonShine resources! To do this, you need to implement the events you need in the resource.
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
