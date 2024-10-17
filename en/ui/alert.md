# Alert

- [Basics](#basics)
- [Notifications type](#type)
- [Icon](#icon) 
- [Deleting notifications](#removable) 

---

<a name="basics"></a>
## Basics

If you need a notification on the page, you can use the `moonshine::alert` component.

```php
<x-moonshine::alert>Alert</x-moonshine::alert>
```

> [!NOTE]
> Alert

<a name="type"></a>
## Notification type

You can change the notification type by specifying the `type` component.

Available types:

- `<span class="badge badge-primary">primary</span>`
- `<span class="badge badge-secondary">secondary</span>`
- `<span class="badge badge-success">success</span>`
- `<span class="badge badge-warning">warning</span>`
- `<span class="badge badge-error">error</span>`
- `<span class="badge badge-info">info</span>`

```php
<x-moonshine::alert type="primary">Primary</x-moonshine::alert>
<x-moonshine::alert type="secondary">Secondary</x-moonshine::alert>
<x-moonshine::alert type="success">Success</x-moonshine::alert>
<x-moonshine::alert type="info">Info</x-moonshine::alert>
<x-moonshine::alert type="warning">Warning</x-moonshine::alert>
<x-moonshine::alert type="error">Error</x-moonshine::alert>
```

<a name="icon"></a>
## Icon

It is possible for a notification to change its icon; to do this, you need to pass it to the `icon` parameter.

```php
<x-moonshine::alert icon="heroicons.academic-cap">Alert</x-moonshine::alert>
```

> [!NOTE]
> Alert

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons) .

<a name="removable"></a>
## Deleting notifications

To remove notifications after some time, you need to pass the `removable` parameter with the value `TRUE`.

```php
<x-moonshine::alert removable="true">Alert</x-moonshine::alert>
```
