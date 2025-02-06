# Alert

- [Основы](#basics)
- [Тип уведомления](#type)
- [Иконка](#icon)
- [Удаление уведомлений](#removable)

---

<a name="basics"></a>
## Основы

Если вам нужно уведомление на странице, вы можете использовать компонент `moonshine::alert`.

```blade
<x-moonshine::alert>Alert</x-moonshine::alert>
```

> [!NOTE]
> Alert

<a name="type"></a>
## Тип уведомления

Вы можете изменить тип уведомления, указав компонент `type`.

Доступные типы:

- `<span class="badge badge-primary">primary</span>`,
- `<span class="badge badge-secondary">secondary</span>`,
- `<span class="badge badge-success">success</span>`,
- `<span class="badge badge-warning">warning</span>`,
- `<span class="badge badge-error">error</span>`,
- `<span class="badge badge-info">info</span>`.

```blade
<x-moonshine::alert type="primary">Primary</x-moonshine::alert>
<x-moonshine::alert type="secondary">Secondary</x-moonshine::alert>
<x-moonshine::alert type="success">Success</x-moonshine::alert>
<x-moonshine::alert type="info">Info</x-moonshine::alert>
<x-moonshine::alert type="warning">Warning</x-moonshine::alert>
<x-moonshine::alert type="error">Error</x-moonshine::alert>
```

<a name="icon"></a>
## Иконка

Есть возможность для уведомления изменить иконку, для этого необходимо передать ее в параметр `icon`.

```blade
<x-moonshine::alert icon="heroicons.academic-cap">Alert</x-moonshine::alert>
```

> [!NOTE]
> Alert

> [!NOTE]
> Более подробную информацию смотрите в разделе [Иконки](/docs/{{version}}/appearance/icons).

<a name="removable"></a>
## Удаление уведомлений

Чтобы удалить уведомления через некоторое время, необходимо передать параметр `removable` со значением `TRUE`.

```blade
<x-moonshine::alert removable="true">Alert</x-moonshine::alert>
```
