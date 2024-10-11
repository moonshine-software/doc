# Индикатор прогресса

- [Основы](#basics)
- [Радиальный](#radial)

---

<a name="basics"></a>
## Основы

Компонент `moonshine::progress-bar` позволяет создать индикатор прогресса.

Доступные цвета:

- ![primary](#)
- ![secondary](#)
- ![success](#)
- ![warning](#)
- ![error](#)
- ![info](#)

```php
<x-moonshine::progress-bar
    color="primary"
    :value="33"
>
    33%
</x-moonshine::progress-bar>
```

<a name="radial"></a>
## Радиальный

Чтобы создать радиальный индикатор прогресса, нужно передать компоненту параметр `radial` со значением `TRUE`.

Доступные размеры:

- sm
- md
- lg
- xl

```php
<x-moonshine::progress-bar
    color="secondary"
    :radial="true"
    :value="33"
    size="md"
>
    33%
</x-moonshine::progress-bar>
```
