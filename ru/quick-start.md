---
video: https://youtu.be/kC1KIdO_MZ4?si=sPPVUjeEzjUI6krA&t=126
---

# Быстрый старт

**MoonShine** — это админ-панель для **Laravel**, которая помогает быстро запускать **MVP**, внутренние кабинеты, **CRM** и **CMS**.
Ниже — пошаговая инструкция по установке и первичной настройке.

### 1. Установка

#### Laravel

Убедитесь, что у вас установлен **Laravel** `10.48+`. Подробнее в [документации Laravel](https://laravel.com/docs/installation).

```shell
composer global require laravel/installer

laravel new example-app

cd example-app
```

#### MoonShine

```shell
composer require moonshine/moonshine
```

#### Starter kit

Если у вас уже установлен `laravel/installer`, то вы можете установить **Laravel** + **MoonShine** одной командой:

```shell
laravel new example-app --using=moonshine/app
```

### 2. Настройка

```shell
php artisan moonshine:install -Q
```

Создайте первого администратора. Введите e-mail (логин), имя и пароль — эти данные будут использоваться для входа.

![make-user](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/quick-start-user.png)

### 3. Запуск проекта

Запустите локальный сервер:

```shell
php artisan serve
```

Откройте в браузере: `http://127.0.0.1:8000/admin`

Войдите под учётной записью администратора.

### 4. Создание первого ресурса

Сгенерируйте ресурс для модели (например, `User`):

```shell
php artisan moonshine:resource User
```

Готово! Теперь раздел `Users` доступен в админке.

`http://127.0.0.1:8000/admin/resource/user-resource/index-page`

Также вы найдёте его в меню.

![user-resource](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/user-resource.png)

### 5. Настройка ресурса

Раздел добавлен, но если открыть страницу создания записей, вы увидите пустую страницу без полей формы. Давайте это исправим.

Воспользуемся полями `Text`, `Email`, `Password` и компонентами для лучшей структуры и сразу добавим валидацию.

```php
class UsersFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make('Contact information', [
                        ID::make(),
                        Text::make('Name'),
                        Email::make('E-mail', 'email'),
                    ]),

                    LineBreak::make(),

                    Box::make('Change password', [
                        Password::make('Password')
                            ->customAttributes(['autocomplete' => 'new-password']),

                        PasswordRepeat::make('Password repeat')
                            ->customAttributes(['autocomplete' => 'confirm-password']),
                    ]),
                ]),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'name' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($item->id),
            ],
            'password' => !$item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
        ];
    }
}
```

Изменим заголовок раздела, добавив метод `getTitle()` для удобства локализации в будущем:

```php
public function getTitle(): string
{
    return __('Clients');
}
```

Также рекомендуется указать `$column`, чтобы изменить отображаемое поле при связях. Вместо `id` укажем `email`:

```php
protected string $column = 'email';
```

### 6. Фильтрация записей

Добавим фильтр по email на индексной странице:

```php
class UsersIndexPage extends IndexPage
{
    protected function filters(): iterable
    {
        return [
            Text::make('E-mail', 'email')
                ->onApply(fn(Builder $query, ?string $value) => $value === null ? $query : $query->whereLike('email', "%$value%")),
        ];
    }

    // ...
}
```

### 7. Брендирование

Настроим логотип и цветовую схему в `App\Providers\MoonShineServiceProvider.php`:

```php
$config
    ->logo('/images/logo.png')
    ->logo('/images/logo-mini.png', small: true);

$colors
    ->primary('#2563EB')
    ->secondary('#93C5FD');
```

### 8. Локализация

Настройка локализации в `config/moonshine.php`:

```php
'locale' => 'ru',
'locales' => [
    'en',
    'ru'
],
```

> Языковые файлы должны находиться в `/lang/vendor/moonshine`. Их можно найти в разделе [Плагины](/plugins) или сделать самостоятельно.

### 9. Документация

Мы установили **MoonShine**, настроили ресурс, добавили поля, фильтры, брендирование и локализацию.

Рекомендуем изучить [документацию](https://moonshine-laravel.com/docs), рецепты и видео-гайды, чтобы использовать все возможности платформы.

Важные разделы:
- [Конфигурация](/docs/{{version}}/configuration)
- [Меню](/docs/{{version}}/appearance/menu)
- [Ресурсы](/docs/{{version}}/model-resource/index)
- [Страницы](/docs/{{version}}/page/index)
- [Поля](/docs/{{version}}/fields/index)
- [Компоненты](/docs/{{version}}/components/index)

Спасибо, что выбрали MoonShine!
