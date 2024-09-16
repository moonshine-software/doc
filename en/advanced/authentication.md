https://moonshine-laravel.com/docs/resource/advanced/advanced-authentication?change-moonshine-locale=en

------

# Authentication

  - [Basics](#basics)
  - [Empowerment](#empowerment)
  - [Login form](#login-form)
  - [Profile](#profile)
  - [Pipelines](#pipelines)

<a name="basics"></a>
## Basics

The MoonShine admin panel has an authentication system. By default it is enabled but if you need to allow access for all users,then it can be disabled in the configuration file `config/moonshine.php`.
           
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

<a name="extending"></a>
## Empowerment          

If you use your own guard, provider, then they can be overridden in the configuration, as well as the `MoonshineUser` model.    
               
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

<a name="form"></a>
## Login form

You can completely replace the login form with your own, just replace the class in the config with yours, and inside implement FormBuilder  

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
## Profile

You can completely replace the profile page with your own, just replace the page class in the config with yours

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

You can override profile fields in the configuration file `config/moonshine.php`.
                           
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
> If you don't want to use an avatar, then specify `'avatar'=>''` or `'avatar'=>false`.

It is possible to change *Guard* in the Profile component.
```php
Profile::make(guard: 'custom')
```

```php
MoonShineAuth::guard('custom')->user()
```
<a name="pipelines"></a>
## Pipelines

In the **MoonShine** admin panel it is possible to add logic to the authentication process, which will allow you to change the request or response object in the process.

To do this, you need to specify your Pipelines in the configuration file `config/moonshine.php`.

```php
return [
    'auth' => [
        'pipelines' => [
            PipelineClass::class
        ],
    ]
];
```

or

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
