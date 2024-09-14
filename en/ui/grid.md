https://moonshine-laravel.com/docs/resource/ui-components/ui-grid?change-moonshine-locale=en

------
# Grid/Column

To arrange elements on the page, you can use `moonshine::grid` and `moonshine::column` components.

> [!NOTE]
> The grid consists of 12 columns.

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



`adaptiveColSpan` - the number of columns that the block occupies for screen sizes up to 1280px.
`colSpan` - the number of columns that the block occupies for screen sizes of 1280px or more.




