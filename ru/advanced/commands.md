# Команды

- [Установка](#install)
- [Apply](#apply)
- [Компонент](#component)
- [Контроллер](#controller)
- [Поле](#field)
- [Обработчик](#handler)
- [Страница](#page)
- [Политика](#policy)
- [Ресурс](#resource)
- [Приведение типов](#type_cast)
- [Пользователь](#user)
- [Публикация](#publish)

---

> [!WARNING]
> Для выбора соответствующего пункта необходимо использовать клавишу `пробел`.

<a name="install"></a>
## Установка

Команда для установки пакета **MoonShine** в ваш проект *Laravel*:

```php
php artisan moonshine:install
```

Доступные опции:

- `-u`, `--without-user` - без создания супер-пользователя;
- `-m`, `--without-migrations` - без выполнения миграций.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Установка](https://moonshine-laravel.com/docs/resource/getting-started/installation).

<a name="apply"></a>
## Apply

Команда для создания класса apply:

```php
php artisan moonshine:apply
```

После выполнения команды в директории `app/MoonShine/Applies` будет создан файл. Созданный класс необходимо зарегистрировать в сервис-провайдере.

<a name="component"></a>
## Компонент

Команда создает пользовательский компонент:

```php
php artisan moonshine:component
```

После выполнения команды в директории `app/MoonShine/Components` будет создан класс для компонента, а в директории `resources/views/admin/components` - файл *Blade*.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Компоненты](https://moonshine-laravel.com/docs/resource/components/components-index).

<a name="controller"></a>
# Контроллер

Команда для создания контроллера:

```php
php artisan moonshine:controller
```

После выполнения команды в директории `app/MoonShine/Controllers` будет создан класс контроллера, который можно использовать в маршрутах админ-панели.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Контроллеры](https://moonshine-laravel.com/docs/resource/advanced/advanced-controller).

<a name="field"></a>
## Поле

Команда позволяет создать пользовательское поле:

```php
php artisan moonshine:field
```

При выполнении команды можно указать, будет ли поле расширять базовый класс или другое поле.

После выполнения команды в директории `app/MoonShine/Fields` будет создан класс поля, а в директории `/resources/views/admin/fields` - файл *Blade*.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле](https://moonshine-laravel.com/docs/resource/fields/fields-index).

<a name="handler"></a>
## Обработчик

Команда создает класс Handler для собственных реализаций импорта и экспорта:

```php
php artisan moonshine:handler
```

После выполнения команды в директории `app/MoonShine/Handlers` будет создан класс обработчика.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Импорт/Экспорт](https://moonshine-laravel.com/docs/resource/models-resources/resources-import_export).

<a name="page"></a>
## Страница

Команда создает страницу для админ-панели:

- `--crud` - создает группу страниц: индексную, детальную и форму;
- `--dir=` - директория, в которой будут располагаться файлы относительно `app/MoonShine`, по умолчанию Page;
- `--extends=` - класс, который будет расширять страница, например IndexPage, FormPage или DetailPage.

После выполнения команды в директории `app/MoonShine/Pages` будет создана страница по умолчанию (или группа страниц).

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Страница](https://moonshine-laravel.com/docs/resource/page/page-class).

<a name="policy"></a>
## Политика

Команда создает *Policy*, привязанную к пользователю админ-панели:

```php
php artisan moonshine:policy
```

После выполнения команды в директории `app/Policies` будет создан класс.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Авторизация](https://moonshine-laravel.com/docs/resource/advanced/advanced-authorization).

<a name="resource"></a>
## Ресурс

Команда для создания ресурсов:

```php
php artisan moonshine:resource
```

Доступные опции:

- `--m|model=` - Eloquent модель для модельного ресурса;
- `--t|title=` - заголовок раздела;
- `--test` или `--pest` - дополнительно сгенерировать тестовый класс.

При создании *Resource* доступно несколько вариантов:

- **[Модельный ресурс по умолчанию](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#default)** - модельный ресурс с общими полями;
- **[Отдельный модельный ресурс](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#separate)** - модельный ресурс с разделением полей;
- **[Модельный ресурс со страницами](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages)** - модельный ресурс со страницами;
- **Пустой ресурс** - пустой ресурс.

После выполнения команды в директории `app/MoonShine/Resources/` будет создан файл ресурса.
Если создается модельный ресурс со страницами, в директории `app/MoonShine/Pages` будут созданы дополнительные страницы.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Модельные ресурсы](https://moonshine-laravel.com/docs/resource/models-resources/resources-index).

<a name="type_cast"></a>
## Приведение типов

Команда создает класс TypeCast для работы с данными:

```php
php artisan moonshine:type-cast
```

После выполнения команды в директории `app/MoonShine/TypeCasts` будет создан файл.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts).

<a name="user"></a>
## Пользователь

Команда, позволяющая создать супер-пользователя:

```php
php artisan moonshine:user
```

Доступные опции:

- `--u|username=` - логин/email пользователя;
- `--N|name=` - имя пользователя;
- `--p|password=` - пароль.

<a name="publish"></a>
## Публикация

Команда для публикации:

```php
php artisan moonshine:publish
```
Для публикации доступно несколько вариантов:

- **Assets** - ассеты админ-панели **MoonShine**;
- **[Assets template](https://moonshine-laravel.com/docs/resource/appearance/appearance-assets#vite)** - создает шаблон для добавления собственных стилей в админ-панель **MoonShine**;
- **[Layout](https://moonshine-laravel.com/docs/resource/appearance/appearance-layout_builder)** - класс MoonShineLayout, отвечающий за общий внешний вид админ-панели;
- **[Favicons](https://moonshine-laravel.com/docs/resource/appearance/appearance-index#favicons)** - переопределяет шаблон для изменения фавиконок;
- **System Resources** - системные MoonShineUserResource, MoonShineUserRoleResource, которые вы можете изменить.

#### Вы можете сразу указать тип публикации в команде.

```php
php artisan moonshine:publish assets
```

Доступные типы:
- assets
- assets-template
- layout
- favicons
- resources
