# Thumbnail 

-[Basics](#basics)
-[Group of images](#multiple)

---

<a name="basics"></a>
## Basics
 
To create thumbnails, you can use the `moonshine::thumbnails` component.

```blade
<x-moonshine::thumbnails value="/images/thumb_1.jpg"/>
```

You can also specify the `alt` attribute.

```blade
<x-moonshine::thumbnails value="/images/thumb_1.jpg" alt="Description"/>
```

<a name="multiple"></a>
## Group of images

You can pass an array of images to the component.

```blade
<x-moonshine::thumbnails :values="[
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg'
]"/>
```

