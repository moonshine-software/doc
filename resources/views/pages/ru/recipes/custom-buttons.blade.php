<x-recipe id="custom-buttons" title="{{ $title ?? 'Кастомные кнопки' }}">

<x-p>
    Добавим кастомные кнопки в индексную таблицу.
</x-p>

<x-code language="php">
public function indexButtons(): array
{
    $resource = new CommentResource();
    return [
        ActionButton::make('Custom button', static fn ($data): string => to_page(
            page: $resource->formPage(),
            resource: $resource,
            params: ['resourceItem' => $data->getKey()]
        ))
    ];
}
</x-code>

</x-recipe>
