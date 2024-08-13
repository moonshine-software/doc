<x-page title="Валидация" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#errors', 'label' => 'Отображение ошибок валидации'],
        ['url' => '#messages', 'label' => 'Сообщения'],
        ['url' => '#prepare', 'label' => 'Подготовка входных данных'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Валидация выполнена так же просто, как и в <code>FormRequests</code> классах от Laravel.
</x-p>

<x-p>
    Достаточно в привычной нам манере добавлять правила в методе <code>rules()</code> ресурса.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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

<x-sub-title id="errors">Отображение ошибок валидации</x-sub-title>
<x-p>
    Параметр ресурса <code>$errorsAbove</code> отвечает за отображение ошибок валидации в верхней части формы. По умолчанию установлено значение <code>true</code>, что означает, что ошибки валидации будут отображаться.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/errors_above_true.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/errors_above_true_dark.png') }}"></x-image>

<x-p>
    Чтобы скрыть ошибки валидации в верхней части формы, установите для параметра ресурса <code>$errorsAbove</code> значение <code>false</code>.
</x-p>
<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...
    protected bool $errorsAbove = false;// [tl! focus]
    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/errors_above_false.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/errors_above_false_dark.png') }}"></x-image>

<x-sub-title id="messages">Сообщения</x-sub-title>

<x-p>
    Используя метод <code>validationMessages()</code> можно создать свои сообщения об ошибках валидации.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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
