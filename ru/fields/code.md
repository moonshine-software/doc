# Code

- [Язык](#language)
- [Нумерация строк](#line-numbers)

Расширяет [Textarea](https://moonshine-laravel.com/docs/resource/fields/fields-textarea)
*имеет те же функции

Поле *Code* является расширением *Textarea* с визуальным отображением редактируемого кода.

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
    ];
}
//...
```

![code](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/code.png)
![code_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/code_dark.png)

<a name="language"></a>
## Язык

По умолчанию используется стилизация PHP, но с помощью метода `language()` вы можете изменить оформление для другого языка программирования.

```php
language(string $language)
```

Поддерживаемые языки: `HTML`, `XML`, `CSS`, `PHP`, `JavaScript` и многие другие.

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->language('js')
    ];
}
//...
```

<a name="line-numbering"></a>
## Нумерация строк

Метод `lineNumbers()` позволяет отображать нумерацию строк.

```php
lineNumbers()
```

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->lineNumbers()
    ];
}
```
