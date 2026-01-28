# Команды

- [Установка](#install)
- [Пользователь](#user)
- [Ресурс](#resource)
- [Страница](#page)
- [Layout](#layout)
- [Компонент](#component)
- [Поле](#field)
- [Контроллер](#controller)
- [Обработчик](#handler)
- [Политика](#policy)
- [Приведение типов](#type_cast)
- [Публикация](#publish)
- [Apply](#apply)
- [Список ресурсов](#resources-list)
- [Список страниц](#pages-list)

---

> [!WARNING]
> Для выбора соответствующего пункта необходимо использовать клавишу `пробел`.

<a name="install"></a>
## Установка

Команда для установки пакета **MoonShine** в ваш проект **Laravel**:

```shell
php artisan moonshine:install
```

Сигнатура:

```
moonshine:install {--u|without-user} {--m|without-migrations} {--l|default-layout} {--a|without-auth} {--d|without-notifications} {--t|tests-mode} {--Q|quick-mode}
```

Доступные опции:

- `--u|without-user` - без создания супер-пользователя,
- `--m|without-migrations` - без выполнения миграций,
- `--l|default-layout` - выбор шаблона по умолчанию,
- `--a|without-auth` - без аутентификации,
- `--d|without-notifications` - без уведомлений,
- `--t|tests-mode` - тестовый режим,
- `--Q|quick-mode` - "быстрый" режим (пропускаются все диалоги с использованием параметров по умолчанию).

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Установка](/docs/{{version}}/installation).

<a name="user"></a>
## Пользователь

Команда для создания супер-пользователя:

```shell
php artisan moonshine:user
```

Сигнатура:

```
moonshine:user {--u|username=} {--N|name=} {--p|password=}
```

Доступные опции:

- `--u|username=` - логин/email пользователя,
- `--N|name=` - имя пользователя,
- `--p|password=` - пароль.

<a name="resource"></a>
## Ресурс

Команда для создания ресурсов:

```shell
php artisan moonshine:resource
```

Сигнатура:
```
moonshine:resource {className?} {--type=} {--m|model=} {--t|title=} {--test} {--pest} {--force} {--p|policy} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--type=` - быстрый выбор типа ресурса (1 - ModelResource (по умолчанию), 2 - CrudResource, 3 - Blank Resource),
- `--m|model=` - Eloquent модель для `ModelResource`,
- `--t|title=` - заголовок раздела,
- `--test` или `--pest` - дополнительно сгенерировать тестовый класс,
- `--force` - перезаписать ресурс без дополнительно подтверждения, если уже существует,
- `--p|policy` - также создать Policy,
- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

При создании ресурса доступно несколько вариантов:

- [ModelResource](/docs/{{version}}/model-resource/fields) - стандартный ресурс для управления Eloquent моделями,
- [CrudResource](/docs/{{version}}/advanced/crud-resource) - ресурс без зависимости от Eloquent,
- **Blank Resource** - пустой ресурс для кастомных реализаций.

После выполнения команды будет создан файл ресурса с CRUD-страницами.

Примеры:
```shell
php artisan moonshine:resource Post --model=CustomPost --title="Articles"

php artisan moonshine:resource Post --model="App\Models\CustomPost"
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [ModelResource](/docs/{{version}}/model-resource/index).

<a name="page"></a>
## Страница

Команда для создания страниц:

```shell
php artisan moonshine:page
```

Сигнатура:
```
moonshine:page {className?} {--force} {--without-register} {--skip-menu} {--crud} {--dir=} {--extends=} {--base-dir=} {--base-namespace=} {--resource=}
```

Доступные опции:

- `--force` - не спрашивать тип страницы,
- `--without-register` - без автоматической регистрации в провайдере,
- `--skip-menu` - не добавлять эту страницу в меню при использовании автозагрузки меню,
- `--crud` - создает группу страниц: индексную, детальную и форму,
- `--dir=` - директория, в которой будут располагаться файлы относительно `app/MoonShine`, по умолчанию Page,
- `--extends=` - класс, который будет расширять страница, например `IndexPage`, `FormPage` или `DetailPage`,
- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса,
- `--resource=` - ресурс, для которого создаётся страница, по умолчанию это `ModelResource`.

После выполнения команды в директории `app/MoonShine/Pages` будет создана страница по умолчанию (или группа страниц).

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Страница](/docs/{{version}}/page/index).

<a name="layout"></a>
## Layout

Команда для создания layout'а:

```shell
php artisan moonshine:layout
```

Сигнатура:
```
moonshine:layout {className?} {--default} {--palette=} {--dir=} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--default` - установить в конфиге как шаблон по умолчанию,
- `--palette=` - выбрать класс палитры, который будет назначен layout'у (по умолчанию используется значение из конфигурации),
- `--dir=` - директория, в которой будут располагаться файлы относительно `app/MoonShine`, по умолчанию `Layouts`,
- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Layout](/docs/{{version}}/appearance/layout).

<a name="component"></a>
## Компонент

Команда для создания пользовательского компонента:

```shell
php artisan moonshine:component
```

Сигнатура:
```
moonshine:component {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

После выполнения команды в директории `app/MoonShine/Components` будет создан класс для компонента,
а в директории `resources/views/admin/components` - файл `Blade`.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Components](/docs/{{version}}/components/index).

<a name="field"></a>
## Поле

Команда для создания пользовательского поля:

```shell
php artisan moonshine:field
```

Сигнатура:
```
moonshine:field {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

При выполнении команды можно указать, будет ли поле расширять базовый класс или другое поле.

После выполнения команды в директории `app/MoonShine/Fields` будет создан класс поля,
а в директории `/resources/views/admin/fields` - файл `Blade`.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поле](/docs/{{version}}/fields/index).

<a name="controller"></a>
# Контроллер

Команда для создания контроллера:

```shell
php artisan moonshine:controller
```

Сигнатура:
```
moonshine:controller {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

После выполнения команды в директории `app/MoonShine/Controllers` будет создан класс контроллера, который можно использовать в маршрутах админ-панели.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Контроллеры](/docs/{{version}}/advanced/controllers).

<a name="handler"></a>
## Обработчик

Команда для создания класса `Handler`:

```shell
php artisan moonshine:handler
```

Сигнатура:
```
moonshine:handler {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

После выполнения команды в директории `app/MoonShine/Handlers` будет создан класс обработчика.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Handlers](/docs/{{version}}/advanced/handlers).

<a name="policy"></a>
## Политика

Команда для создания класса `Policy`, привязанного к пользователю админ-панели:

```shell
php artisan moonshine:policy
```

После выполнения команды в директории `app/Policies` будет создан класс.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Безопасность > Авторизация](/docs/{{version}}/security/authorization).

<a name="type_cast"></a>
## Приведение типов

Команда для создания класса `TypeCast` для работы с данными:

```shell
php artisan moonshine:type-cast
```

Сигнатура:
```
moonshine:type-cast {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

После выполнения команды в директории `app/MoonShine/TypeCasts` будет создан файл.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [TypeCasts](/docs/{{version}}/advanced/type-casts).

<a name="publish"></a>
## Публикация

Команда для публикации:

```shell
php artisan moonshine:publish
```

Для публикации доступно несколько вариантов:

- **Assets** - ассеты админ-панели **MoonShine**,
- **Assets template** - создает шаблон для добавления собственных стилей или создания собственной темы для **MoonShine**,
- **System Resources** - системные `MoonShineUserResource`, `MoonShineUserRoleResource`, которые вы можете изменить,
- **System Forms** - системные `LoginForm`, `FiltersForm`, которые вы можете изменить,
- **System Pages** - системные `ProfilePage`, `LoginPage`, `ErrorPage`, которые вы можете изменить.

#### Вы можете сразу указать тип публикации в команде.

```shell
php artisan moonshine:publish assets
```

Доступные типы:
- assets
- assets-template
- resources
- forms
- pages

<a name="apply"></a>
## Apply

Команда для создания класса apply:

```shell
php artisan moonshine:apply
```

Сигнатура:
```
moonshine:apply {className?} {--base-dir=} {--base-namespace=}
```

Доступные опции:

- `--base-dir=, --base-namespace=` - изменить базовую директорию и неймспейс класса.

После выполнения команды в директории `app/MoonShine/Applies` будет создан файл.
Созданный класс необходимо зарегистрировать в сервис-провайдере.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Поля](/docs/{{version}}/fields/basic-methods#apply).

<a name="resources-list"></a>
## Список ресурсов

Команда для отображения списка всех зарегистрированных ресурсов **MoonShine**:

```shell
php artisan moonshine:resources
```

Сигнатура:
```
moonshine:resources {--json}
```

Доступные опции:

- `--json` - вывод в формате JSON.

Команда отображает все зарегистрированные ресурсы вместе с их страницами в удобочитаемом формате, аналогичном выводу `route:list`.

При использовании опции `--json` вывод будет в JSON-формате, что удобно для автоматизации и интеграции с другими инструментами.

<a name="pages-list"></a>
## Список страниц

Команда для отображения списка всех зарегистрированных отдельных страниц **MoonShine** (без страниц, принадлежащих ресурсам):

```shell
php artisan moonshine:pages
```

Сигнатура:
```
moonshine:pages {--json}
```

Доступные опции:

- `--json` - вывод в формате JSON.

Команда отображает только самостоятельные страницы, которые не принадлежат ресурсам. Страницы ресурсов отображаются в команде `moonshine:resources`.

При использовании опции `--json` вывод будет в JSON-формате.
