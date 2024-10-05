# Code

- [Основы](#basics)
- [Language](#language)
- [Нумерация строк](#line-numbers)

---

<a name="basics"></a>
## Основы

Наследует [Textarea](/docs/{{version}}/fields/textarea).

\* имеет те же возможности.

Поле Code является расширением Textarea с визуальным оформлением редактируемого кода.

```php
use MoonShine\UI\Fields\Code;

Code::make('Code')
```

![fields_code](https://moonshine-laravel.com/screenshots/code.png)

<a name="language"></a>
## Language

По умолчанию используется оформление для PHP, но с помощью метода `language()` можно изменить оформление для другого языка программирования.

```php
language(string $language)
```

Поддерживаемые языки: _HTML , XML , CSS , PHP , JavaScript_ и многие другие.

```php
use MoonShine\UI\Fields\Code;

Code::make('Code')
    ->language('js') 
```

<a name="line-numbers"></a>
## Нумерация строк

```php
lineNumbers()
```

```php
use MoonShine\UI\Fields\Code;

 Code::make('Code')
    ->lineNumbers()
```