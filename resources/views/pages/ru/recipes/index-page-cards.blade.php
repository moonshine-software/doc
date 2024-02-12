<x-recipe id="index-page-cards" title="{{ $title ?? 'Рецепт' }}">

<x-p>
    Изменим на индексной странице отображение элементов через компонент <em>CardsBuilder</em>.
</x-p>

<x-code language="php">
class MoonShineUserIndexPage extends IndexPage
{
    public function listComponentName(): string
    {
        return 'index-cards';
    }

    public function listEventName(): string
    {
        return 'cards-updated';
    }

    protected function itemsComponent(iterable $items, Fields $fields): MoonShineRenderable
    {
        return CardsBuilder::make($items, $fields)
            ->cast($this->getResource()->getModelCast())
            ->name($this->listComponentName())
            ->async()
            ->overlay()
            ->title('email')
            ->subtitle('name')
            ->url(fn ($user) => $this->getResource()->formPageUrl($user))
            ->thumbnail(fn ($user) => asset($user->avatar))
            ->buttons($this->getResource()->getIndexItemButtons());
    }
}
</x-code>

</x-recipe>
