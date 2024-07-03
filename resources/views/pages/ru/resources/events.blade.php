<x-page title="Events">

<x-p>
    Так как MoonShine работает на основе стандартных eloquent методов по добавлению, редактированию и удалению, то вы можете легко использовать стандартные Laravel events:
    <x-link link="https://laravel.com/docs/eloquent#events">events</x-link>
</x-p>
<x-p>
    Но также возникает потребность привязаться именно к событиям в рамках ресурсов MoonShine!
    Для этого в ресурсе необходимо реализовать нужные Вам события
</x-p>

<x-code language="php">
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
</x-code>

</x-page>
