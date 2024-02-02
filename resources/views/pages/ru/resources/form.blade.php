<x-page title="Форма" :sectionMenu="[
    'Разделы' => [
        ['url' => '#validation', 'label' => 'Валидация'],
        ['url' => '#buttons', 'label' => 'Кнопки'],
        ['url' => '#async', 'label' => 'Асинхронный режим'],
    ]
]">

<x-sub-title id="validation">Основы</x-sub-title>

<x-p>
    Валидация выполнена так же просто, как и в <code>FormRequests</code> классах от Laravel.
</x-p>

<x-p>
    Достаточно в привычной нам манере добавлять правила в методе <code>rules()</code> ресурса модели.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function rules($item): array // [tl! focus:start]
    {
        return [
            'title' => ['required', 'string', 'min:5']
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/validation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/validation_dark.png') }}"></x-image>

<x-sub-title id="messages">Сообщения</x-sub-title>

<x-p>
    Используя метод <code>validationMessages()</code> можно создать свои сообщения об ошибках валидации.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function validationMessages(): array // [tl! focus:start]
    {
        return [
            'email.required' => 'Required email'
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="prepare">Подготовка входных данных для проверки</x-sub-title>

<x-p>
    Если вам нужно подготовить или очистить какие-либо данные из запроса, прежде чем применять свои правила проверки,
    вы можете использовать метод <code>prepareForValidation()</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function prepareForValidation(): void // [tl! focus:start]
    {
        request()?->merge([
            'email' => request()
                ?->string('email')
                ->lower()
                ->value()
        ]);
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Для добавления кнопок используются ActionButton и методы <code>FormButtons</code> или <code>buttons</code> в ресурсе
</x-p>
<x-moonshine::alert type="default" icon="heroicons.information-circle">
    <x-link link="{{ to_page('action_button') }}">Подробнее ActionButton</x-link>
</x-moonshine::alert>

<x-code>
public function formButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-p>
    Также можно воспользоваться методом <code>buttons</code>, но в таком случае кнопки будут и на всех остальных страницах ресурса
</x-p>

<x-code>
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Переключить режим без перезагрузки для сохранения данных
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true; // [tl! focus]

    // ...
}
</x-code>

<x-p>
    Переключить режим формы в Precognitive валидацию
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isPrecognitive = true; // [tl! focus]

    // ...
}
</x-code>
</x-page>
