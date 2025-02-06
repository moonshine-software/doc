# Icon

- [Basics](#basics)
- [Size](#size)
- [Color](#color)
- [Customization](#customization)

---

<a name="basics"></a>
## Basics

 To insert icons into your custom elements, you can use the `moonshine::icon` component.
 
> [!NOTE]
> All available [icons](/docs/{{version}}/appearance/icons).

<a name="size"></a>
## Size

Using the `size` parameter you can set the size of the icon.
```blade
<x-moonshine::icon icon="heroicons.academic-cap" size="16"/>
```

> [!TIP]
> The value of the `size` parameter corresponds to the dimensions in TailwindCSS.

<a name="color"></a>
## Color

```blade
<x-moonshine::icon icon="heroicons.academic-cap" color="primary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="secondary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-900"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-50"/>
```

> [!TIP]
> There are several colors available by default, but you can expand them using your own [color classes](/docs/{{version}}/appearance/assets) TailwindCSS.

<a name="customization"></a>
## Customization

A custom style for icons can be set using the `class` parameter.

```blade
<x-moonshine::icon
    size="10"
    icon="heroicons.academic-cap"
    class="bg-green-500 text-white rounded-full p-2"
/>
```

> [!TIP]
> Build MoonShine contains a limited list of TailwindCSS classes. Use [custom styles](/docs/{{version}}/appearance/assets).
