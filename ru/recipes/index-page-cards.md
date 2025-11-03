# Индексная страница через CardsBuilder

Давайте изменим отображение элементов на индексной странице через компонент `CardsBuilder`.

Создаем класс с компонентом индексной страницы, реализующий интерфейс `DefaultListComponentContract`. Его мы потом можем переиспользовать на любых других индексных страницах ресурсов.

```php
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Core\Traits\WithCore;
use MoonShine\Crud\Contracts\Page\IndexPageContract;
use MoonShine\Crud\Contracts\PageComponents\DefaultListComponentContract;
use MoonShine\UI\Components\CardsBuilder;


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

В классе индексной страницы ресурса переопределяем свойство `$component`:

```php
use App\MoonShine\Resources\MoonShineUserResource;
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
