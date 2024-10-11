# Collapse

- [Основы](#basics)
- [Показать развернутым](#show)
- [Сохранение состояния](#persist)

---

<a name="basics"></a>
## Основы

Компонент `moonshine::collapse` позволяет сворачивать контент.

```php
<x-moonshine::collapse title="Hide / Show">
    {{ fake()->text() }}
</x-moonshine::collapse>
```

<a name="show"></a>
## Показать развернутым

Если параметр `show` имеет значение `TRUE`, то по умолчанию блок будет отображаться развернутым.

```php
<x-moonshine::collapse title="Hide / Show" :open="true">
    {{ fake()->text() }}
</x-moonshine::collapse>
```

<a name="persist"></a>
## Сохранение состояния

Если параметр `persist` установлен в значение `TRUE`, то состояние блока будет сохранено.

```php
<x-moonshine::collapse title="Hide / Show" :persist="true">
    {{ fake()->text() }}
</x-moonshine::collapse>
```
