<x-page title="Валидация" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#messages', 'label' => 'Сообщения'],
        ['url' => '#prepare', 'label' => 'Подготовка входных данных'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

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

</x-page>
