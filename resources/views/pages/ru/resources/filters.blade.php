<x-page title="Фильтры" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Для создания фильтров используются так же поля,
    они отображаются только на главной странице раздела.
</x-p>

<x-p>
    Чтобы указать по каким полям осуществлять фильтрацию данных,
    достаточно в вашем ресурсе модели в методе <code>filters()</code>,
    вернуть массив с необходимыми полями.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод отсутствует, либо возвращает пустой массив, то фильтры не будут отображаться
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Некоторые поля не могут участвовать в построении запроса на фильтрацию,
    поэтому они будут автоматически исключены из списка фильтров
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array // [tl! focus:start]
    {
        return [
            Text::make('Title', 'title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поля являются ключевым звеном построения форм в админ-панели <strong>Moonshine</strong>.<br />
    <x-link link="{{ to_page('fields-index') }}">Подробнее о Полях</x-link>
</x-moonshine::alert>

<x-p>
    Если необходимо кешировать состояние фильтров, воспользуйтесь свойство <code>saveFilterState</code> в ресурсе
</x-p>
<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $saveFilterState = true; // [tl! focus]
//...
}
</x-code>
</x-page>
