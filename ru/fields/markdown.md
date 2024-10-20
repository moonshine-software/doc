# Markdown

- [Установка](#installation)
- [Основы](#basics)
- [Конфиг по умолчанию](#default-config)
- [Toolbar](#toolbar)
- [Options](#options)

---

> [!NOTE]
> Подробнее о поле можно узнать в [репозитории](https://github.com/moonshine-software/easymde).

> [!NOTE]
> Работает на основе [EasyMDE](https://github.com/Ionaru/easy-markdown-editor) библиотеки.


<a name="installation"></a>
## Установка

Для использования поля - необходимо установить пакет:

```bash
composer require moonshine/easymde
```

<a name="basics"></a>
## Основы

Наследует [Textarea](/docs/{{version}}/fields/textarea.md).

\* имеет те же возможности.

```php
use MoonShine\EasyMde\Fields\Markdown;

Markdown::make('Description')
```

<a name="default-config"></a>
## Конфиг по умолчанию

Поле `Markdown` по умолчанию использует наиболее распространенные настройки, такие как плагины, панель меню и панель инструментов.

Чтобы изменить настройки по умолчанию, необходимо опубликовать файл конфигурации:

```bash
php artisan vendor:publish --tag="moonshine-easymde-config"
```

Вы также можете добавить дополнительные параметры в файл конфигурации, которые будут применяться ко всем полям `Markdown`.

```php
return [
    'previewClass' => ['prose', 'dark:prose-invert'],
    'forceSync' => true,
    'spellChecker' => false,
    'status' => false,
    'toolbar' => [
        'bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule', '|', 'heading-1',
        'heading-2', 'heading-3', '|', 'table', 'unordered-list', 'ordered-list', '|', 'link', 'image', '|',
        'preview', 'side-by-side', 'fullscreen', '|', 'guide',
    ],
];
```

<a name="toolbar"></a>
## Toolbar

Метод `toolbar()` позволяет полностью переопределить панель инструментов для поля.

```php
toolbar(string|bool|array $toolbar)
```

```php
Markdown::make('Description')
    ->toolbar(['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule'])
```

<a name="options"></a>
## Options

Метод `addOption()` позволяет добавлять дополнительные параметры для поля.

```php
addOption(string $name, string|int|float|bool|array $value)
```

```php
Markdown::make('Description')
    ->addOption('toolbar', ['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule'])
```
