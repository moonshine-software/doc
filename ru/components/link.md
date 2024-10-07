# Компонент Link

- [Создание](#make)
- [Иконка](#icon)
- [Бейдж](#badge)
- [Кнопка](#button)
- [Заполнение](#filled)
- [Подсказка](#tooltip)

---

<a name="make"></a>
## Создание

Компонент *Link* позволяет создавать ссылки.
Вы можете создать *Link*, используя статический метод `make()` класса `Link`.

```php
make(Closure|string $href, Closure|string $label = '')
```

- `$href` - URL ссылки,
- `$label` - заголовок. 

```php
use MoonShine\Components\Link;

//...

public function components(): array
{
    return [
        Link::make(
            '/endpoint',
            'Ссылка'
        )
    ];
}

//...
```
<a name="icon"></a>
## Иконка

Метод `icon()` позволяет указать иконку для ссылки.
                
```php
icon(string $icon)
```

```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Редактировать')
    ->icon('heroicons.outline.pencil')

//...
```

<a name="badge"></a>
## Бейдж

Метод `badge()` позволяет добавить бейдж к ссылке.
                    
```php
badge(Closure|string|int|float|null $value)
```
                        
```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Комментарии')
    ->badge(fn() => Comment::count())
//...
```

<a name="button"></a>
## Кнопка        
              
Метод `button()` позволяет отображать ссылку как кнопку.
 ```php
 button()
 ```

 ```php
 use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Ссылка')
    ->button()

//...
```

<a name="filled"></a>
## Заполнение
               
Метод `filled()` устанавливает заполнение для ссылки.
    
```php
filled()
```
                         
```php
use MoonShine\Components\Link;
//...
Link::make('/endpoint', 'Ссылка')
    ->filled()

//...
```

<a name="tooltip"></a>
## Подсказка   

Метод `tooltip()` позволяет установить подсказку для ссылки.        
                  
```php
tooltip(?string $tooltip = null)
```
                         
```php
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Ссылка')
    ->tooltip('Подсказка для ссылки')

//...
```
