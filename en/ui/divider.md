# Divider

- [Basics](#basics)
- [Text separator](#text)

---

<a name="basics"></a>
# Basics

The `moonshine::divider` component allows you to create a stylized content divider.

```php
{{ fake()->text(100) }}
<x-moonshine::divider />
{{ fake()->text(100) }}
```

<a name="text"></a>
# Text separator

You can use text as a separator. To do this, you need to specify the text in the `label` parameter.

```php
{{ fake()->text(100) }}
<x-moonshine::divider label="Divider" />
{{ fake()->text(100) }}
```

The `centered` parameter allows you to center the text.

```php
{{ fake()->text(100) }}
<x-moonshine::divider label="Divider" :centered="true" />
{{ fake()->text(100) }}
```
