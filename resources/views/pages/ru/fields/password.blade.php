<x-page title="Пароль">

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-p>
    Поля <em>Password</em> и <em>PasswordRepeat</em> предназначены для работы с паролями,
    у них по умолчанию установленно <code>type=password</code>.
</x-p>

<x-p>
    Поле <em>Password</em> в preview отображается как <x-moonshine::badge>***</x-moonshine::badge>,
    а при выполнении метода <code>apply()</code> значение поля кодируется с помощью фасада <code>Hash</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Password; // [tl! focus]

//...

public function fields(): array
{
    return [
        Password::make('Password') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    <em>PasswordRepeat</em> используется как вспомогательное поле для подтверждения пароля
    и не изменяет данные при выполнении метода <code>apply()</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat; // [tl! focus]

//...

public function fields(): array
{
    return [
        Password::make('Password'),
        PasswordRepeat::make('Password repeat', 'password_repeat') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
