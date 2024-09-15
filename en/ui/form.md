https://moonshine-laravel.com/docs/resource/ui-components/ui-form?change-moonshine-locale=en

------
# Form elements

  - [Basics](#basics)
  - [Label](#label)
  - [Input](#input)
  - [Checkbox](#checkbox)
  - [Radio](#radio)
  - [Color](#color)
  - [Button](#button)
  - [Hint](#hint)
  - [File](#file)
  - [Slide range](#slide-range)
  - [Select](#select)
  - [Switcher](#switcher)
  - [Textarea](#textarea)
  - [Errors](#errors)
  - [Precognition](#precognition)

> [!TIP]
> Form components are wrappers of similar HTML elements; they can be passed all the necessary attributes.

<a name="basics"></a>
### Basics

The *Form* component is designed to create forms.

```php
<x-moonshine::form raw>
    // form elements
</x-moonshine::form>
```

The component creates `html` markup for the future form.

```php
<form
    class="form" method="POST"
    x-id="['form']"
    :id="$id('form')"
>
    <input type="hidden" name="_token" value="huwre3xs9N9k82ThhkGVVfzWuf0L6heHRnEAogHD" autocomplete="off">

    // form elements

</form>
```

#### Buttons

The Form component allows you to place buttons in a separate block, To do this, you need to pass them in the `buttons` slot.

```php
<x-moonshine::form>
    <x-moonshine::form.input
        name="title"
        placeholder="Title"
        value=""
    />
    <x-slot:buttons>
        <x-moonshine::form.button type="reset">Cancel</x-moonshine::form.button>
        <x-moonshine::form.button class="btn-primary">Submit</x-moonshine::form.button>
    </x-slot:buttons>
</x-moonshine::form>
```

#### Errors

The `errors` parameter allows you to display a list of errors.

```php
<x-moonshine::form raw error>
    // form elements
</x-moonshine::form>
```

If there are several forms on the page, it is recommended to set `name` to the form, to display errors only for a specific form.

```php
<x-moonshine::form raw error name="my-form">
    // form elements
</x-moonshine::form>
```

#### Precognition

The `precognitive` parameter allows you to enable the Precognition mode for the form.

```php
<x-moonshine::form precognitive>
    // form elements
</x-moonshine::form>
```

<a name="label"></a>
### Label

```php
<x-moonshine::form.label name="slug">
    Slug
</x-moonshine::form.label>
```

If a field is required, you can pass the `required` attribute to style the element.

```php
<x-moonshine::form.label name="title" required>
    Title
</x-moonshine::form.label>
```

<a name="input"></a>
### Input

```php
<x-moonshine::form.input
    name="title"
    placeholder="Title"
    value=""
/>
```

<a name="checkbox"></a>
### Checkbox

```php
<x-moonshine::form.label>
    <x-moonshine::form.input
        name="property[]"
        type="checkbox"
        value="1"
    />
    Property 1 
</x-moonshine::form.label>
```

<a name="radio"></a>
### Radio

```php
<x-moonshine::form.label>
    <x-moonshine::form.input
        name="variant"
        type="radio"
        value="1"
    />
    Variant 1 
</x-moonshine::form.label>
```

<a name="color"></a>
### Color

```php
<x-moonshine::form.input
    name="color"
    type="color"
    value="#ec4176"
/>
```

<a name="button"></a>
### Button

```php
<x-moonshine::form.button>Click me</x-moonshine::form.button>
```

<a name="hint"></a>
### Hint

```php
<x-moonshine::form.hint>
    {{ fake()->sentence() }}
</x-moonshine::form.hint>
```

<a name="file"></a>
### File

```php
<x-moonshine::form.file name="file" />
```

Using the component, you can display previously downloaded files.

```php
<x-moonshine::form.file
    :files="[
        '/images/thumb_1.jpg',
        '/images/thumb_2.jpg',
        '/images/thumb_3.jpg'
    ]"
    :raw="[
        'thumb_1.jpg',
        'thumb_2.jpg',
        'thumb_3.jpg'
    ]"
    name="images[]"
    multiple="multiple"
/>
```

> [!NOTE]
> `files` - array of url files for output
> `raw` - array of source data (value stored in the database).

You can pass additional parameters to the component:

`download` - downloading the uploaded file
`removable` - removal from the list of downloaded files
`imageable` - displaying preview image

```php
<x-moonshine::form.file
    :files="[
        '/images/thumb_1.jpg',
        '/images/thumb_2.jpg',
        '/images/thumb_3.jpg'
    ]"
    :raw="[
        'thumb_1.jpg',
        'thumb_2.jpg',
        'thumb_3.jpg'
    ]"
    name="images[]"
    multiple="multiple"
    :download="true"
    :removable="false"
    :imageable="false"
/>
```

<a name="slide-range"></a>
### Slide range

```php
<x-moonshine::form.slide-range
    fromName="from"
    toName="to"
    fromValue="1000"
    toValue="9000"
    min="0"
    max="10000"
/>
```

<a name="select"></a>
### Select

```php
<x-moonshine::form.select
    :values="[
        1 => 'Option 1',
        2 => 'Option 2'
    ]"
    value="2"
/>
```

or through `slot:options`

```php
<x-moonshine::form.select>
    <x-slot:options>
        <option value="1">Option 1</option>
        <option selected value="2">Option 2</option>
    </x-slot:options>
</x-moonshine::form.select>
```

You can combine values into groups.

```php
<x-moonshine::form.select
    :values="[
        'Italy' => [
            1 => 'Rome',
            2 => 'Milan'
        ],
        'France' => [
            3 => 'Paris',
            4 => 'Marseille'
        ],
    ]"
    :searchable="true"
/>
```

You can pass additional parameters to the component:

`searchable` - search by values
`nullable` - may matter `NULL`

```php
<x-moonshine::form.select
    :values="[
        1 => 'Option 1',
        2 => 'Option 2'
    ]"
    :nullable="true"
    :searchable="true"
/>
```

To load values asynchronously, you need to specify the url for the `asyncRoute` attribute, which will return data in json format.

```php
<x-moonshine::form.select asyncRoute='url' />
```

<a name="switcher"></a>
### Switcher

```php
<x-moonshine::form.switcher
    :onValue="true"
    :offValue="false"
    checked="checked"
/>
```

`onValue` - active value
`offValue` - inactive value

<a name="textarea"></a>
### Textarea

```php
<x-moonshine::form.textarea>
    {{ fake()->text() }}
</x-moonshine::form.textarea>
```
