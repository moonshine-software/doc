<x-page title="Events">

<x-p>
    Так как MoonShine работает на основе стандартных eloquent методов по добавлению, редактированию и удалению, то вы можете легко использовать стандартные Laravel events:
    <x-link link="https://laravel.com/docs/eloquent#events">events</x-link>
</x-p>
<x-p>
    Но также возникает потребность привязаться именно к событиям в рамках ресурсов MoonShine! Для этого в ресурсе необходимо реализовать нужные Вам события
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
