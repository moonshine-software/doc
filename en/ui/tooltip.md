https://moonshine-laravel.com/docs/resource/ui-components/ui-tooltip?change-moonshine-locale=en

------
# Tooltip
  - [Basics](#basics)
  - [Without using a component](#without)

<a name="basics"></a>
### Basics

Using the `moonshine::tooltip` component, you can create convenient tooltips.

Available locations:
- bottom
- top
- left
- right

```php
<x-moonshine::tooltip placement="bottom" content="Tooltip text">
    <button class="btn">Trigger</button>
</x-moonshine::tooltip>
```

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-span-4">
    <div class="box">
    
    <span class="inline-block" x-data="tooltip(`Tooltip text`, {placement: 'bottom'})">
    <button class="btn">Trigger</button>
</span>
</div>
</div>
</div>

<a name="without"></a>
### Without using a component

```php
<span x-data="tooltip('Tooltip content 1', {placement: 'top'})">
    <a class="text-purple font-semibold">Trigger 1</a>
</span>
or
<span
    x-data="tooltip"
    data-tippy-content="Tooltip content 2"
    data-tippy-placement="right">
    <a class="text-purple font-semibold">Trigger 2</a>
</span>


<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-span-4">
    <div class="box">
    
    <span x-data="tooltip('Tooltip content 1', {placement: 'top'})"><!-- [tl! focus:start] -->
    <a class="text-purple font-semibold">Trigger 1</a>
</span><!-- [tl! focus:end] -->
or
<span
    x-data="tooltip"
    data-tippy-content="Tooltip content 2"
    data-tippy-placement="right">
    <a class="text-purple font-semibold">Trigger 2</a>
</span><!-- [tl! focus:-5] -->
</div>
</div>
</div>
```
