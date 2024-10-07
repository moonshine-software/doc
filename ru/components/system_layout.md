# Системный компонент Layout

- [Создание](#make)
- [Blade](#blade)

---

<a name="make"></a>
## Создание

Системный компонент *Layout* служит основой для построения любой страницы в **MoonShine**. Он включает в себя тег `body` и базовые элементы разметки, а также необходимые классы и скрипты.

Вы можете создать *Layout*, используя статический метод `make()` класса `LayoutBuilder`.

```php
make(array $components = [])
```

```php
use MoonShine\Components\LayoutBuilder
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            // ...
        ]);
    }
}
```

<a name="blade"></a>
## Blade

Компонент можно использовать в *html* разметке:

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :class="$store.darkMode.on && 'dark'"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @moonShineAssets
</head>
<x-moonshine::layout>
    //...
</x-moonshine::layout>
</html>
```
