<x-page title="Пароль">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Все то же самое как и "Текстовое поле", меняется только input type = password
</x-p>

<x-p>
    Ну и как правило может идти вместе с полем с подтверждением пароля
</x-p>

<x-code language="php">
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;

//...

public function fields(): array
{
    return [
        Password::make('Пароль', 'password')->hideOnIndex(),  // [tl! focus]
        PasswordRepeat::make('Повторите пароль', 'password_repeat')->hideOnIndex(),  // [tl! focus]
    ];
}

//...

</x-code>

</x-page>
