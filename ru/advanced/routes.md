# Routes

MoonShine под капотом использует стандартный Laravel Routing. Все отображаемые страницы рендерятся через PageController, который имеет очень простой вид

```php
public function __invoke(MoonShineRequest $request): PageContract  
{  
    $request->getResource()?->loaded();  
  
    $page = $request  
        ->getPage()  
        ->checkUrl()  
        ->loaded();  
  
    return $page;  
}
```

Тем самым вы вольны использовать самостоятельно объявленные роуты и контроллеры (если требуется) и рендерить страницы или то что требуется

Для правильный работы CRUD страниц, необходимо передавать роут параметры `resourceUri` и `pageUri`, `resourceUri` опционален, так как не все страницы имеют ресурс

Пример стандартного роута

```php
Route::get('/admin/{resourceUri}/{pageUri}', CustomController::class)
	->middleware(['moonshine', \MoonShine\Laravel\Http\Middleware\Authenticate::class])
	->name('moonshine.name');
```

Данный пример включает в себя роут с параметрами ресурса и страницы, а также группу middlewares moonshine список которой распалагается в конфиге moonshine.php и middleware Authenticate для доступа к ендпоинту только для авторизованного пользователя

Для быстрый реализации примера выше, можно воспользоваться Route директивой moonshine

```php
Route::moonshine(static function (Router $router) {  
    $router->post(  
        'permissions/{resourceItem}',  
        PermissionController::class  
    )->name('permissions');  
}, resource: true, page: true, authenticate: true);

// result
// POST /admin/{resourceUri}/{pageUri}/permissions/{resourceItem}
// middlewares: moonshine, Authenticate::class
```

```php
Route::moonshine(static function (Router $router) {  
    // 
}, 
// add prefix {resourceUri}
resource: false, 
// add prefix {pageUri}
page: false, 
// add middleware Authenticate::class
authenticate: false
);
```

Наилучший путь создать `routes/moonshine.php` и внутри объявлять собственные роуты

> [!NOTE]
>При создании файла `routes/moonshine.php` не забудьте объявить его в системе
>

> [!WARNING]
> Нельзя одновременно использовать группы middlewares web и moonshine, так как они делают одно и тоже и одновременно запускают сессии
>

