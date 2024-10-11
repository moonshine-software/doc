# Divider

- [Основы](#basics)
- [Текстовый разделитель](#text)

---

<a name="basics"></a>
# Основы

Компонент `moonshine::divider` позволяет создать стилизованный разделитель контента.

```php
{{ fake()->text(100) }}
<x-moonshine::divider />
{{ fake()->text(100) }}
```

<a name="text"></a>
# Текстовый разделитель

Вы можете использовать текст в качестве разделителя. Для этого необходимо указать текст в параметре `label`.

```php
{{ fake()->text(100) }}
<x-moonshine::divider label="Divider" />
{{ fake()->text(100) }}
```

Параметр `centered` позволяет центрировать текст.

```php
{{ fake()->text(100) }}
<x-moonshine::divider label="Divider" :centered="true" />
{{ fake()->text(100) }}
```
