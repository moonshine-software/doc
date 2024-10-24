# Code

- [Установка](#installation)
- [Основы](#basics)
- [Конфиг по умолчанию](#default-config)
- [Language](#language)
- [Themes](#themes)
- [Options](#options)

---

> [!NOTE]
> Подробнее о поле можно посмотреть в [репозитории пакета](https://github.com/moonshine-software/ace)

<a name="installation"></a>
## Установка

Перед использованием требуется установить пакет:

```bash
composer require moonshine/ace
```

<a name="basics"></a>
## Основы

Наследует [Textarea](/docs/{{version}}/fields/textarea).

\* имеет те же возможности.

Поле Code является расширением Textarea с визуальным оформлением редактируемого кода.

```php
use MoonShine\Ace\Fields\Code;

Code::make('Code')
```

![fields_code](https://moonshine-laravel.com/screenshots/code.png)

> [!NOTE]
> Поле работает на основе [Ace](https://ace.c9.io/) библиотеки.


<a name="default-config"></a>
## Конфиг по умолчанию

Чтобы изменить настройки по умолчанию, необходимо опубликовать файл конфигурации:

```bash
php artisan vendor:publish --tag="moonshine-ace-config"
```

Вы также можете добавить дополнительные параметры в файл конфигурации, которые будут применяться ко всем `Code` полям.

```php
'options' => [
    'language' => 'javascript',
    'options' => [
        'useSoftTabs' => true,
        'navigateWithinSoftTabs' => true,
    ],
    'themes' => [
        'light' => 'chrome',
        'dark' => 'cobalt'
    ],
],
```

<a name="language"></a>
## Language

По умолчанию используется оформление для PHP, но с помощью метода `language()` можно изменить оформление для другого языка программирования.

```php
language(string $language)
```

Поддерживаемые языки: _HTML , XML , CSS , PHP , JavaScript_ и многие другие.

```php
Code::make('Code')
    ->language('js') 
```

<a name="themes"></a>
## Themes

Чтобы изменить темы - используйте `themes()` метод.

```php
themes(string $light = null, string $dark = null)
```

```php
Code::make('Code')
    ->themes('chrome', 'cobalt');
```

<a name="options"></a>
## Options

`addOption()` метод позволяет вам добавить дополнительные опции для поля.

```php
addOption(string $name, string|int|float|bool $value)
```
```php
Code::make('Code')
    ->addOption('showGutter', false)
```