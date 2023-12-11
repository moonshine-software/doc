<x-page title="Password">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Password</em> and <em>PasswordRepeat</em> fields are intended for working with passwords,
    they have <code>type=password</code> set by default.
</x-p>

<x-p>
    The <em>Password</em> field in preview is displayed as <x-moonshine::badge>***</x-moonshine::badge>,
    and when the <code>apply()</code> method is executed, the value of the field is encoded using the <code>Hash</code> facade.
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
    <em>PasswordRepeat</em> is used as an auxiliary field to confirm the password
    and does not change the data when executing the <code>apply()</code> method.
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
