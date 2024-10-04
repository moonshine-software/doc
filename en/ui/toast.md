https://moonshine-laravel.com/docs/resource/ui-components/ui-toast?change-moonshine-locale=en

------
# Toast

  - [Basics](#basics)
  - [Without using a component](#without)
  - [JS](#js)


<a name="basics"></a>
## Basics

You can create notifications using the `moonshine::toast` component.

```blade
<x-moonshine::toast content="Message toast" />
```
Available types:



<span class="badge badge-primary">primary</span>
<span class="badge badge-secondary">secondary</span>
<span class="badge badge-success">success</span>
<span class="badge badge-warning">warning</span>
<span class="badge badge-error">error</span>
<span class="badge badge-info">info</span>


```blade
<x-moonshine::toast type="success" content="Message success toast" />


    <div x-data="{ show(){$dispatch('toast', {type: 'default', text: 'Message default toast'})} }">
        <button class="btn" @click="show()">Default</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'primary', text: 'Message primary toast'})} }">
        <button class="btn" @click="show()">Primary</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'secondary', text: 'Message secondary toast'})} }">
        <button class="btn" @click="show()">Secondary</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'success', text: 'Message success toast'})} }">
        <button class="btn" @click="show()">Success</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'info', text: 'Message info toast'})} }">
        <button class="btn" @click="show()">Info</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'warning', text: 'Message warning toast'})} }">
        <button class="btn" @click="show()">Warning</button>
    </div>

    <div x-data="{ show(){$dispatch('toast', {type: 'error', text: 'Message error toast'})} }">
        <button class="btn" @click="show()">Error</button>
    </div>

```
<a name="without"></a>
## Without using a component

You can also create a notification using the `MoonShineUi::toast()` method.

```php
use MoonShine\MoonShineUI;

MoonShineUI::toast('Toast content', 'error');
```

<a name="js"></a>
## JS


```js
// native js
dispatchEvent(
    new CustomEvent('toast', {
        detail: {type: 'success', text: 'SomeText'}
    })
)

// AlpineJs inside the component
this.$dispatch('toast', {type: 'error', text: 'Error'})

// AlpineJs outside the component
$dispatch('toast', {type: 'error', text: 'Error'})
```
