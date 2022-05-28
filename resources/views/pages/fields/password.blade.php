<x-page title="Пароль">

<x-p>
    Все тоже самое как и "Текстовое поле", меняется только input type = password
</x-p>

<x-p>
    Ну и как правило может идти вместе с полем с подтверждением пароля
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Password;
use Leeto\MoonShine\Fields\PasswordRepeat;

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

<x-next href="{{ route('section', 'fields-number') }}">Число</x-next>

</x-page>



