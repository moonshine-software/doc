# Декоратор Fragment

- [Создание](#make)
- [Асинхронное событие](#async)

---

<a name="make"></a>
## Создание

Иногда вам нужно вернуть только часть шаблона в вашем HTTP-ответе. Для этого вы можете использовать [Blade Fragments](https://laravel.com/docs/blade#rendering-blade-fragments). Декоратор *Fragment* позволяет создавать соответствующие блоки.

Вы можете создать *Fragment*, используя статический метод `make()`.

```php
make(array $fields = [])
```

Метод `name()` устанавливает имя для фрагмента.

```php
use MoonShine\Decorations\Fragment;
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Fragment::make([
            Text::make('Имя', 'first_name')
        ])
            ->name('fragment-name')
    ];
}

//...
```

<a name="async"></a>
## Асинхронное событие

Вы можете включить область в Fragment и установить событие на эту область, вызывая которое можно будет обновить фрагмент

```php
Fragment::make($fields)
    ->name('fragment-name'),
```

И в качестве примера давайте вызовем событие для успешной отправки формы
    
```php
FormBuilder::make()->async(asyncEvents: 'fragment-updated-fragment-name')
```

Вы также можете передать дополнительные параметры с запросом через массив
    
```php
Fragment::make($fields)
    ->name('fragment-name')
    ->updateAsync(['resourceItem' => request('resourceItem')]),
```

#### Передача параметров

Метод `withParams()` позволяет передавать значения полей с запросом, используя селекторы элементов.

```php
Fragment::make($fields)
    ->withParams([
        'start_date' => '#start_date',
        'end_date' => '#end_date'
    ])
    ->name('fragment-name'),
```
