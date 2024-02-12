<x-recipe id="index-page-cards" title="{{ $title ?? 'Receipt' }}">

<x-p>
    Let's change the display of elements on the index page through the <em>CardsBuilder</em> component.
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
