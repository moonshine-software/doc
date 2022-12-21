<x-page title="События">

<x-p>
    Так как moonShine работает на основе стандартных eloquent методов по добавлению, редактированию и удалению, то вы можете легко использовать стандартные laravel events:
</x-p>

<x-link link="https://laravel.com/docs/9.x/eloquent#events">https://laravel.com/docs/9.x/eloquent#events</x-link>


<x-p>
    Но также возникает потребность привязаться именно к событиям в рамках ресурсов MoonShine!
    Для этого в ресурсе необходимо реализовать нужные Вам события
</x-p>

<x-code language="php">
protected function beforeCreating(Model $item)
{
    // Событие перед добавлением записи
}

protected function afterCreated(Model $item)
{
    // Событие после добавления записи
}

protected function beforeUpdating(Model $item)
{
    // Событие перед обновлением записи
}

protected function afterUpdated(Model $item)
{
    // Событие после обновления записи
}

protected function beforeDeleting(Model $item)
{
    // Событие перед удалением записи
}

protected function afterDeleted(Model $item)
{
    // Событие после удаления записи
}

protected function beforeMassDeleting(array $ids)
{
    // Событие перед массовым удалением записей
}

protected function afterMassDeleted(array $ids)
{
    // Событие после массового удаления записей
}
</x-code>

</x-page>
