https://moonshine-laravel.com/docs/resource/ui-components/ui-spinner?change-moonshine-locale=en

------
# Spinner

<a name="basics"></a>
## Basics

Using the `moonshine::spinner` component you can create loading indicators.

```php
<x-moonshine::spinner />
```

<a name="size"></a>
## Size

Available sizes:

- sm
- md
- lg
- xl


```php
<x-moonshine::spinner size="sm" />
<x-moonshine::spinner size="md" />
<x-moonshine::spinner size="lg" />
<x-moonshine::spinner size="xl" />
```

<a name="color"></a>
## Color

Available colors:

<span class="badge badge-primary">primary</span>
<span class="badge badge-secondary">secondary</span>
<span class="badge badge-success">success</span>
<span class="badge badge-warning">warning</span>
<span class="badge badge-error">error</span>
<span class="badge badge-info">info</span>

```php
<x-moonshine::spinner color="primary" />
<x-moonshine::spinner color="secondary" />
<x-moonshine::spinner color="success" />
<x-moonshine::spinner color="warning" />
<x-moonshine::spinner color="error" />
<x-moonshine::spinner color="info" />
```

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-span-4">
        <div class="box flex gap-2">
            <div class="spinner spinner-sm spinner--primary"></div>
            <div class="spinner spinner-sm spinner--secondary"></div>
            <div class="spinner spinner-sm spinner--success"></div>
            <div class="spinner spinner-sm spinner--warning"></div>
            <div class="spinner spinner-sm spinner--error"></div>
            <div class="spinner spinner-sm spinner--info"></div>
        </div>
    </div>
</div>

<a name="position"></a>
## Positioning

The `absolute="true"` parameter specifies the absolute positioning of the loading indicator.

```php
<x-moonshine::spinner :absolute="true" />
```

The `fixed="true"` parameter specifies a fixed positioning of the loading indicator.

```php
<x-moonshine::spinner :fixed="true" />
```
