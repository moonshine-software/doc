# Аутентификация и профиль

- [Вступление](#intro)
- [Routes](#routes)
- [Layouts](#layouts)
- [Страницы](#pages)
- [Controllers](#controllers)

<a name="intro"></a>
## Вступление

Данный рецепт демонстрирует использование `MoonShine` не в роли панели администратора, а в роли личного кабинета под модель `User` с логином, регистрацией, восстановлением пароля и профилем (базовый набор). 
Хороший пример работы с разными `Layout` под разные страницы.

<a name="routes"></a>
## Routes

Начнем с маршрутизации, но для начала создадим несколько контроллеров:

- `AuthenticateController`
- `ForgotController`
- `ProfileController`
- `RegisterController`

Объявим маршруты в `routes/web.php`:

```php
<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\MoonShine\Pages\ResetPasswordPage;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'form')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->middleware('guest')->name('authenticate');
    Route::delete('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(ForgotController::class)->middleware('guest')->group(function () {
    Route::get('/forgot', 'form')->name('forgot');
    Route::post('/forgot', 'reset')->name('forgot');
    Route::get('/reset-password/{token}', static fn (ResetPasswordPage $page) => $page)->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
});

Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get('/register', 'form')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(ProfileController::class)->middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', 'index')->name('profile');
    Route::post('/', 'update')->name('profile.update');
});
```

> [!NOTE]
> `ResetPasswordPage` мы создадим немного позже

<a name="layouts"></a>
## Layouts

У нас будут страницы с формами входа, регистрации и восстановления пароля и они будут отличаться шаблоном от страницы с профилем пользователя, поэтому нам необходимо создать 2 шаблона:

- `AppLayout` - для профиля
- `FormLayout` - для аутентификации

### AppLayout

Начнем с выполнения команды на создание шаблона

```shell
php artisan moonshine:layout AppLayout --compact
```

Далее соберем конструктор из нужных нам компонентов

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\PackageCategoryResource;
use App\MoonShine\Resources\PackageResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\{Components,
    Layout\Block,
    Layout\Body,
    Layout\Content,
    Layout\Flash,
    Layout\Html,
    Layout\Layout,
    Layout\Wrapper};

final class AppLayout extends CompactLayout
{
    protected function getHomeUrl(): string
    {
        return route( 'home');
    }

    public function build(): Layout
    {
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),

                Body::make([
                    Wrapper::make([
                        Block::make([
                            Flash::make(),

                            Content::make([
                                Components::make(
                                    $this->getPage()->getComponents()
                                ),
                            ]),
                        ])->class('layout-page'),
                    ]),
                ])->class('theme-minimalistic'),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->withThemes(),
        ]);
    }
}
```

### FormLayout

```shell
php artisan moonshine:layout FormLayout --compact
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\UI\Components\{Components,
    FlexibleRender,
    Heading,
    Layout\Block,
    Layout\Body,
    Layout\Content,
    Layout\Flash,
    Layout\Html,
    Layout\Layout,
    Layout\Wrapper};

final class FormLayout extends CompactLayout
{
    protected function getHomeUrl(): string
    {
        return route( 'home');
    }

    public function build(): Layout
    {
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),
                Body::make([
                    Block::make([
                        Block::make([
                            $this->getLogoComponent(),
                        ])->class('authentication-logo'),

                        Block::make([
                            Flash::make(),
                            Components::make($this->getPage()->getComponents()),
                        ])->class('authentication-content'),
                    ])->class('authentication'),
                ]),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->withThemes(),
        ]);
    }
}
```

<a name="pages"></a>
## Страницы

Создадим страницы `MoonShine` для отображения данных:

### LoginPage

Выполним команду создания страницы, а тип выберем `Custom`

```shell
php artisan moonshine:page LoginPage
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\MoonShine\Layouts\FormLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\LineBreak;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class LoginPage extends Page
{
    protected ?string $layout = FormLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'LoginPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('authenticate'))
                ->fields([
                    Text::make('E-mail', 'email')
                        ->required()
                        ->customAttributes([
                            'autofocus' => true,
                            'autocomplete' => 'username',
                        ]),

                    Password::make(__('Password'), 'password')
                        ->required(),

                    Switcher::make(__('Remember me'), 'remember'),
                ])->submit(__('Log in'), [
                    'class' => 'btn-primary btn-lg w-full',
            ]),

            Divider::make(),

            Flex::make([
                ActionButton::make(__('Create account'), route('register'))->primary(),
                Link::make(route('forgot'), __('Forgot password'))
            ])->justifyAlign('start')
        ];
	}
}
```

Также обратите внимание, что у страниц мы указываем нужный шаблон

```php
protected ?string $layout = FormLayout::class;
```

### RegisterPage

```shell
php artisan moonshine:page RegisterPage
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\MoonShine\Layouts\FormLayout;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class RegisterPage extends Page
{
    protected ?string $layout = FormLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'RegisterPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('register.store'))
                ->fields([
                    Text::make(__('Name'), 'name')->required(),
                    Text::make('E-mail', 'email')
                        ->required()
                        ->customAttributes([
                            'autofocus' => true,
                            'autocomplete' => 'off',
                        ]),

                    Password::make(__('Password'), 'password')
                        ->required(),

                    PasswordRepeat::make(__('Repeat password'), 'password_confirmation')
                        ->required(),
                ])->submit(__('Create account'), [
                    'class' => 'btn-primary btn-lg w-full',
                ])->buttons([
                    ActionButton::make(__('Log in'), route('login'))
                ])
        ];
	}
}
```

### ForgotPage

```shell
php artisan moonshine:page ForgotPage
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\MoonShine\Layouts\FormLayout;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Layout\Flash;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class ForgotPage extends Page
{
    protected ?string $layout = FormLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'ForgotPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('forgot'))
                ->fields([
                    Text::make('E-mail', 'email')
                        ->required()
                        ->customAttributes([
                            'autofocus' => true,
                            'autocomplete' => 'off',
                        ]),
                ])->submit(__('Reset password'), [
                    'class' => 'btn-primary btn-lg w-full',
            ]),

            Divider::make(),

            Flex::make([
                ActionButton::make(__('Log in'), route('login'))->primary(),
            ])->justifyAlign('start')
        ];
	}
}
```

### ResetPasswordPage

```shell
php artisan moonshine:page ResetPasswordPage
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\MoonShine\Layouts\FormLayout;
use Illuminate\Contracts\Routing\UrlRoutable;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;

class ResetPasswordPage extends Page
{
    protected ?string $layout = FormLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'ForgotPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('password.update'))
                ->fields([
                    Hidden::make('token')->setValue(request()->route('token')),

                    Text::make('E-mail', 'email')
                        ->setValue(request()->input('email'))
                        ->required()
                        ->readonly(),

                    Password::make(__('Password'), 'password')
                        ->required(),

                    PasswordRepeat::make(__('Repeat password'), 'password_confirmation')
                        ->required(),
                ])->submit(__('Reset password'), [
                    'class' => 'btn-primary btn-lg w-full',
            ]),
        ];
	}
}
```

### ProfilePage

```shell
php artisan moonshine:page ProfilePage
```

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\MoonShine\Layouts\AppLayout;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;

class ProfilePage extends Page
{
    protected ?string $layout = AppLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'LoginPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Box::make([
                FormBuilder::make()
                    ->class('authentication-form')
                    ->action(route('profile.update'))
                    ->fill(auth()->user())
                    ->fields([
                        Tabs::make([
                            Tab::make(__('Profile'), [
                                Text::make(__('Name'), 'name')->required(),
                                Text::make('E-mail', 'email')
                                    ->required()
                                    ->customAttributes([
                                        'autofocus' => true,
                                        'autocomplete' => 'off',
                                    ]),
                            ]),
                            Tab::make(__('Password'), [
                                Password::make(__('Password'), 'password'),
                                PasswordRepeat::make(__('Repeat password'), 'password_confirmation'),
                            ])->active(
                                session('errors')?->has('password') ?? false
                            )
                        ])
                    ])->submit(__('Update profile'), [
                        'class' => 'btn-primary btn-lg w-full',
                    ]),
            ]),

            FormBuilder::make()
                ->name('logout')
                ->class('authentication-form')
                ->action(route('logout'))
                ->fields([
                    Hidden::make('_method')->setValue('DELETE'),
                ])->submit(__('Log out'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),
        ];
    }
}
```

<a name="controllers"></a>
## Controllers

### AuthenticateController

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateFormRequest;
use App\Models\User;
use App\MoonShine\Pages\LoginPage;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Container\Attributes\Authenticated;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AuthenticateController extends Controller
{
    public function form(LoginPage $page): LoginPage
    {
        return $page;
    }

    public function authenticate(AuthenticateFormRequest $request): RedirectResponse
    {
        if(!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => __('moonshine::auth.failed')
            ]);
        }

        return redirect()->intended(
            route('profile')
        );
    }

    public function logout(
        #[Auth]
        Guard $guard,
        Request $request
    ): RedirectResponse {
        $guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(
            url()->previous() ?? route('home')
        );
    }
}
```

Обратите внимание на то как мы рендерим страницы в контроллерах

```php
public function form(LoginPage $page): LoginPage
{
    return $page;
}
```

Также буду выкладывать и `FormRequest` классы, чтобы рецепт был максимально готовым

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthenticateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required', Password::default()],
        ];
    }
}
```

### ForgotController

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Models\User;
use App\MoonShine\Pages\ForgotPage;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use MoonShine\Laravel\MoonShineUI;

class ForgotController extends Controller
{
    public function form(ForgotPage $page): ForgotPage
    {
        return $page;
    }

    public function reset(ForgotPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            MoonShineUI::toast(__('If the account exists, then the instructions are sent to your email'));
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['alert' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function updatePassword(ResetPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('alert', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:dns'],
        ];
    }
}
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRules;

class ResetPasswordFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRules::default()],
        ];
    }
}
```

### ProfileController

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\Models\User;
use App\MoonShine\Pages\ProfilePage;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class ProfileController extends Controller
{
    public function index(
        ProfilePage $page
    ): ProfilePage {
        return $page;
    }

    public function update(
        ProfileFormRequest $request,
        #[CurrentUser] User $user
    ): RedirectResponse
    {
        $data = $request->only(['email', 'name']);

        if($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return to_route('profile');
    }
}
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore(auth()->id())],
            'password' => ['confirmed'],
        ];
    }
}
```

### RegisterController

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\MoonShine\Pages\RegisterPage;
use Illuminate\Http\RedirectResponse;

final class RegisterController extends Controller
{
    public function form(RegisterPage $page): RegisterPage
    {
        return $page;
    }

    public function store(RegisterFormRequest $request): RedirectResponse
    {
        $user = User::query()->create(
            $request->validated()
        );

        auth()->login($user);

        return redirect()->intended(
            route('home')
        );
    }
}
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:dns', Rule::unique('users')],
            'password' => ['required', 'confirmed'],
        ];
    }
}
```

Вот и все! `MoonShine` не ограничивает вас только панелью администратора, ведь это полноценный UI kit