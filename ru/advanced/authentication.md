# Аутентификация

  - [Основы](#basics)
  - [Расширение возможностей](#empowerment)
  - [Форма входа](#login-form)
  - [Профиль](#profile)
  - [Пайплайны](#pipelines)

---

<a name="basics"></a>
## Основы

Админ-панель MoonShine имеет систему аутентификации. По умолчанию она включена, но если вам нужно разрешить доступ для всех пользователей, ее можно отключить в конфигурационном файле `config/moonshine.php`.
           
```php
return [
    // ...
    'auth' => [
        'enable' => true,
        // ...
    ],
    // ...
];
```

![login](https://moonshine-laravel.com/screenshots/login.png)
![login_dark](https://moonshine-laravel.com/screenshots/login_dark.png)

<a name="empowerment"></a>
## Расширение возможностей          

Если вы используете собственный guard, провайдер, то их можно переопределить в конфигурации, а также модель `MoonshineUser`.    
               
```php
return [
    // ...
    'auth' => [
        // ...
        'middleware' => Authenticate::class,
        'guard' => 'moonshine',
        'guards' => [
            'moonshine' => [
                'driver' => 'session',
                'provider' => 'moonshine',
            ],
        ],
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model' => MoonshineUser::class,
            ],
        ],
        // ...
    ],
    // ...
];
```

<a name="login-form"></a>
## Форма входа

Вы можете полностью заменить форму входа на свою, просто заменив класс в конфиге на свой, а внутри реализовать FormBuilder  

```php
return [
    // ...
    'forms' => [
        'login' => LoginForm::class
    ],
    // ...
];
```

<a name="profile"></a>
## Профиль

Вы можете полностью заменить страницу профиля на свою, просто заменив класс страницы в конфиге на свой

```php
return [
    // ...
    'pages' => [
        // ...
        'profile' => ProfilePage::class
    ],
    // ...
];
```

Вы можете переопределить поля профиля в конфигурационном файле `config/moonshine.php`.
                           
```php
return [
    // ...
    'auth' => [
        'enable' => true,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar'
        ],
        'guard' => 'moonshine',
        // ...
    ],
    // ...
];
```

> [!NOTE]
> Если вы не хотите использовать аватар, то укажите `'avatar'=>''` или `'avatar'=>false`.

В компоненте Profile есть возможность изменить *Guard*.
```php
Profile::make(guard: 'custom')
```

```php
MoonShineAuth::guard('custom')->user()
```

<a name="pipelines"></a>
## Пайплайны

В админ-панели **MoonShine** есть возможность добавить логику в процесс аутентификации, что позволит изменить объект запроса или ответа в процессе.

Для этого нужно указать свои Pipelines в конфигурационном файле `config/moonshine.php`.

```php
return [
    'auth' => [
        'pipelines' => [
            PipelineClass::class
        ],
    ]
];
```

или

```php
return [
    'auth' => [
        'pipelines' => [
            new class {
                public function handle($request, $next) {
                    return $next($request);
                }
            }
        ],
    ]
];
```
