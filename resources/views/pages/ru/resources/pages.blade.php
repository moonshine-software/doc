<x-page
    title="ModelResource со страницами"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Добавление полей'],
            ['url' => '#layers', 'label' => 'Слои на странице'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <strong>MoonShine</strong> предоставляет возможность кастомизировать crud страниц <em>ModelResource</em>,
    для этого необходимо, при создании ресурса через команду,
    выбрать тип ресурса<br />
    <code>Model resource with pages</code>.
</x-p>

<x-p>
    В результате будет создан класс ресурса модели и дополнительные классы для индексной, детальной и страницы с формой.<br />
    Располагаться классы страниц по умолчанию будут в директории <code>app/MoonShine/Pages</code>.
</x-p>

<x-p>
    В созданном ресурсе модели в методе <code>pages()</code> будут зарегистрированы crud страницы.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use App\MoonShine\Pages\Post\PostIndexPage; // [tl! focus]
use App\MoonShine\Pages\Post\PostFormPage; // [tl! focus]
use App\MoonShine\Pages\Post\PostDetailPage; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function pages(): array // [tl! focus:start]
    {
        return [
            PostIndexPage::make($this->title()),
            PostFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            PostDetailPage::make(__('moonshine::ui.show')),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="fields">Добавление полей</x-sub-title>

<x-p>
    <x-link link="{{ route('moonshine.page', 'fields-index') }}">Поля</x-link>
    в <strong>MoonShine</strong> используются не только для ввода данных, но и для их вывода.<br />
    Метод <code>fields()</code> в классе <em>crud</em> страницы позволяет указать необходимые поля.
</x-p>

<x-code language="php">
namespace App\MoonShine\Pages\Post;

use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    public function fields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="layers">Слои на странице</x-sub-title>

<x-p>
    Для удобства все <em>crud</em> страницы разбиты на три слоя,
    которые отвечают за отображение определенной области на странице.
</x-p>

<ul>
    <li>
        <code>TopLayer</code> - по умолчанию используется для вывода метрик на индексной странице
        и для дополнительных кнопок на странице редактирования
    </li>
    <li>
        <code>MainLayer</code> - по умолчанию данный слой используется для вывода основной информации используя
        <x-link link="{{ route('moonshine.page', 'advanced-form_builder') }}">FormBuilder</x-link> и
        <x-link link="{{ route('moonshine.page', 'advanced-table_builder') }}">TableBuilder</x-link>
    </li>
    <li><code>BottomLayer</code> - по умолчанию используется для вывода дополнительной информации</li>
</ul>

<x-p>
    Для кастомизации слоев используются соответствующие методы: <code>topLayer()</code>, <code>mainLayer()</code> и
    <code>bottomLayer()</code>. Методы должны возвращать массив <x-link link="{{ route('moonshine.page', 'page-class') . '#components' }}">Компонентов</x-link>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Pages\Post;

use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    //...

    protected function topLayer(): array // [tl! focus:start]
    {
        return [
            ...parent::topLayer()
        ];
    } // [tl! focus:end]

    protected function mainLayer(): array // [tl! focus:start]
    {
        return [
            ...parent::mainLayer()
        ];
    } // [tl! focus:end]

    protected function bottomLayer(): array // [tl! focus:start]
    {
        return [
            ...parent::bottomLayer()
        ];
    } // [tl! focus:end]

    //...
}
</x-code>


</x-page>
