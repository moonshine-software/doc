<x-page title="Events">

<x-p>
    Since MoonShine is based on standard eloquent methods for adding, editing and deleting, you can easily use standard Laravel events:
</x-p>

<x-link link="https://laravel.com/docs/9.x/eloquent#events">https://laravel.com/docs/9.x/eloquent#events</x-link>


<x-p>
    But sometimes you need to snap exactly to the events within the MoonShine resources!
    To do this, you need to implement the events you want in the resource
</x-p>

<x-code language="php">
protected function beforeCreating(Model $item)
{
    // Event before adding an entry
}

protected function afterCreated(Model $item)
{
    // Event after adding a record
}

protected function beforeUpdating(Model $item)
{
    // Event before record update
}

protected function afterUpdated(Model $item)
{
    // Event after record update
}

protected function beforeDeleting(Model $item)
{
    // Event before record deletion
}

protected function afterDeleted(Model $item)
{
    // Event after record deletion
}

protected function beforeMassDeleting(array $ids)
{
    // Event before mass deletion of records
}

protected function afterMassDeleted(array $ids)
{
    // Event after mass deletion of records
}
</x-code>

</x-page>
