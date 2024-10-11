# Пагинация

- [Основы](#basics)
- [Упрощенная пагинация](#simplified-pagination)

---

<a name="basics"></a>
## Основы

Компонент `moonshine::pagination` позволяет создавать стилизованную пагинацию по страницам. Для этого добавьте компонент в blade-представление пагинации.

```php
<x-moonshine::pagination
    :paginator="$paginator"
    :elements="$elements"
/>
```

<a name="simple"></a>
## Упрощенная пагинация

Параметр `simple` со значением `TRUE` позволяет отображать пагинацию в упрощенном виде.

```php
<x-moonshine::pagination
    :paginator="$paginator"
    :elements="$elements"
    :simple="true"
/>
```
