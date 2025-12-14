# Index Page via CardsBuilder

Let's change the display of elements on the index page through the `CardsBuilder` component.

We create a class with an index page component that implements the `DefaultListComponentContract` interface.
We can then reuse it on any other resource index pages.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Core\Traits\WithCore;
use MoonShine\Crud\Contracts\Page\IndexPageContract;
use MoonShine\Crud\Contracts\PageComponents\DefaultListComponentContract;
use MoonShine\UI\Components\CardsBuilder; // [tl! collapse:end]

final class CardsListComponent implements DefaultListComponentContract
{
    use WithCore;


    public function __construct(CoreContract $core) {
        $this->setCore($core);
    }


    /**
     * @param  iterable<array-key, mixed>  $items
     */
    public function __invoke(
        IndexPageContract $page,
        iterable $items,
        FieldsContract $fields
    ): ComponentContract
    {
        $resource = $page->getResource();


        return CardsBuilder::make($items, $fields)
            ->cast($resource->getCaster())
            ->name($page->getListComponentName())
            ->overlay()
            ->url(fn ($user) => $page->getUrl())
            ->thumbnail(fn ($user) => asset($user->avatar))
            ->buttons($page->getButtons())
            ->when($page->isAsync(), function (CardsBuilder $cardsBuilder) use($page): void {
                $cardsBuilder->async(
                    url: fn (): string => $page->getRouter()->getEndpoints()->component(
                        name: $cardsBuilder->getName(),
                        additionally: $this->getCore()->getRequest()->getRequest()->getQueryParams(),
                    ),
                );
            })
            ->when(
                ! \is_null($resource->getItemsResolver()),

                function (CardsBuilder $cardsBuilder) use($resource): void {
                    $cardsBuilder->itemsResolver(
                        $resource->getItemsResolver(),
                    );
                },
            );
    }
}
```

In the resource index page class, we override the `$component` property:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Contracts\PageComponents\DefaultListComponentContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;

/**
 * @extends IndexPage<MoonShineUserResource>
 */
class MoonshineUserIndexPage extends IndexPage
{
    /**
     * @var class-string<DefaultListComponentContract>
     */
    protected string $component = CardsListComponent::class;
}
```
