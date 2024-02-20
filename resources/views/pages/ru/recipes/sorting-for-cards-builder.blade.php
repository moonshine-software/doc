<x-recipe id="sorting-for-cards-builder" title="{{ $title ?? 'Рецепт' }}">

<x-p>
    Создадим сортировку для компонента CardsBuilder:
</x-p>

<x-code language="php">
Select::make('Sorts')->options([
    'created_at' => 'Date',
    'id' => 'ID',
])
    ->onChangeMethod('reSort', events: ['cards-updated-cards'])
    ->setValue(session('sort_column') ?: 'created_at'),


CardsBuilder::make(
    items: Article::query()->with('author')
        ->when(
            session('sort_column'),
            fn($q) => $q->orderBy(session('sort_column'), session('sort_direction', 'asc')),
            fn($q) => $q->latest()
        )
        ->paginate()
)
    ->name('cards')
    ->async()
    ->cast(ModelCast::make(Article::class))
    ->title('title')
    ->url(fn($data) => (new ArticleResource())->formPageUrl($data))
    ->overlay()
    ->columnSpan(4) ,

// ...

public function reSort(MoonShineRequest $request): void
{
    session()->put('sort_column', $request->get('value'));
    session()->put('sort_direction', 'ASC');
}
</x-code>

</x-recipe>
