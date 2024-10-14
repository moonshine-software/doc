# Элементы формы

  - [Основы](#basics)
  - [Метка](#label)
  - [Ввод](#input)
  - [Флажок](#checkbox)
  - [Переключатель](#radio)
  - [Цвет](#color)
  - [Кнопка](#button)
  - [Подсказка](#hint)
  - [Файл](#file)
  - [Диапазон](#slide-range)
  - [Выбор](#select)
  - [Переключатель](#switcher)
  - [Текстовая область](#textarea)
  - [Ошибки](#errors)
  - [Предварительное распознавание](#precognition)

---

> [!TIP]
> Компоненты формы являются обертками аналогичных HTML-элементов; им можно передавать все необходимые атрибуты.

<a name="basics"></a>
## Основы

Компонент *Form* предназначен для создания форм.

```php
<x-moonshine::form raw>
    // элементы формы
</x-moonshine::form>
```

Компонент создает `html` разметку для будущей формы.

```php
<form
    class="form" method="POST"
    x-id="['form']"
    :id="$id('form')"
>
    <input type="hidden" name="_token" value="huwre3xs9N9k82ThhkGVVfzWuf0L6heHRnEAogHD" autocomplete="off">

    // элементы формы

</form>
```

#### Кнопки

Компонент Form позволяет размещать кнопки в отдельном блоке. Для этого нужно передать их в слот `buttons`.

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

#### Ошибки

Параметр `errors` позволяет отображать список ошибок.

```php
<x-moonshine::form raw error>
    // элементы формы
</x-moonshine::form>
```

Если на странице несколько форм, рекомендуется задать `name` форме, чтобы отображать ошибки только для конкретной формы.

```php
<x-moonshine::form raw error name="my-form">
    // элементы формы
</x-moonshine::form>
```

#### Предварительное распознавание

Параметр `precognitive` позволяет включить режим Precognition для формы.

```php
<x-moonshine::form precognitive>
    // элементы формы
</x-moonshine::form>
```

<a name="label"></a>
## Метка

```php
<x-moonshine::form.label name="slug">
    Slug
</x-moonshine::form.label>
```

Если поле обязательно, можно передать атрибут `required` для стилизации элемента.

```php
<x-moonshine::form.label name="title" required>
    Title
</x-moonshine::form.label>
```

<a name="input"></a>
## Ввод

```php
<x-moonshine::form.input
    name="title"
    placeholder="Title"
    value=""
/>
```

<a name="checkbox"></a>
## Флажок

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
## Переключатель

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
## Цвет

```php
<x-moonshine::form.input
    name="color"
    type="color"
    value="#ec4176"
/>
```

<a name="button"></a>
## Кнопка

```php
<x-moonshine::form.button>Click me</x-moonshine::form.button>
```

<a name="hint"></a>
## Подсказка

```php
<x-moonshine::form.hint>
    {{ fake()->sentence() }}
</x-moonshine::form.hint>
```

<a name="file"></a>
## Файл

```php
<x-moonshine::form.file name="file" />
```

С помощью компонента можно отобразить ранее загруженные файлы.

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
> `files` - массив url файлов для вывода
> `raw` - массив исходных данных (значение, хранящееся в базе данных).

Вы можете передать дополнительные параметры компоненту:

`download` - скачивание загруженного файла
`removable` - удаление из списка загруженных файлов
`imageable` - отображение превью изображения

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
## Диапазон

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
## Выбор

```php
<x-moonshine::form.select
    :values="[
        1 => 'Вариант 1',
        2 => 'Вариант 2'
    ]"
    value="2"
/>
```

или через `slot:options`

```php
<x-moonshine::form.select>
    <x-slot:options>
        <option value="1">Вариант 1</option>
        <option selected value="2">Вариант 2</option>
    </x-slot:options>
</x-moonshine::form.select>
```

Вы можете объединять значения в группы.

```php
<x-moonshine::form.select
    :values="[
        'Италия' => [
            1 => 'Рим',
            2 => 'Милан'
        ],
        'Франция' => [
            3 => 'Париж',
            4 => 'Марсель'
        ],
    ]"
    :searchable="true"
/>
```

Вы можете передать дополнительные параметры компоненту:
`searchable` - поиск по значениям
`nullable` - может иметь значение `NULL`

```php
<x-moonshine::form.select
    :values="[
        1 => 'Вариант 1',
        2 => 'Вариант 2'
    ]"
    :nullable="true"
    :searchable="true"
/>
```

Для асинхронной загрузки значений необходимо указать url для атрибута `asyncRoute`, который вернет данные в формате json.
```php

<x-moonshine::form.select asyncRoute='url' />
```

<a name="switcher"></a>
## Переключатель

```php
<x-moonshine::form.switcher
    :onValue="true"
    :offValue="false"
    checked="checked"
/>
```

`onValue` - активное значение
`offValue` - неактивное значение

<a name="textarea"></a>
## Текстовая область

```php
<x-moonshine::form.textarea>
    {{ fake()->text() }}
</x-moonshine::form.textarea>
```
