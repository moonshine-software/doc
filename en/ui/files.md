https://moonshine-laravel.com/docs/resource/ui-components/ui-files?change-moonshine-locale=en

------

# Files

  - [Basics](#basics)
  - [No download](#no-download)

<a name="basics"></a>
## Basics

To display a list of files, you can use the `moonshine::files` component.

```php
<x-moonshine::files :files="[
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg'
]"/>

```

/images/thumb_1.jpg
/images/thumb_2.jpg
/images/thumb_3.jpg


<a name="no-download"></a>
## No download

To disable the ability to download files, you need the component to pass the `download` parameter with the value `FALSE`.

```php
<x-moonshine::files
    :files="[
        '/images/thumb_1.jpg',
        '/images/thumb_2.jpg',
        '/images/thumb_3.jpg'
    ]"
    :download="false"
/>
```

/images/thumb_1.jpg
/images/thumb_2.jpg
/images/thumb_3.jpg

