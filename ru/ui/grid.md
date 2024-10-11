# Grid/Column

Для расположения элементов на странице можно использовать компоненты `moonshine::grid` и `moonshine::column`.

> [!NOTE]
> Сетка состоит из 12 колонок.

```php
<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="6" colSpan="6">
        {{ fake()->text() }}
    </x-moonshine::column>
    <x-moonshine::column adaptiveColSpan="6" colSpan="6">
        {{ fake()->text() }}
    </x-moonshine::column>
</x-moonshine::grid>
```

`adaptiveColSpan` - количество колонок, которые занимает блок для размеров экрана до 1280px.
`colSpan` - количество колонок, которые занимает блок для размеров экрана 1280px и более.
