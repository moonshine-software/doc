https://moonshine-laravel.com/docs/resource/ui-components/ui-table?change-moonshine-locale=en

------
# Table

- [Basics](#basics)
- [Simplified view](#simple)
- [Sticky head](#sticky)
- [Missing elements](#notfound)
- [Slots](#slots)
- [Stylization](#styles)

<a name="basics"></a>
## Basics

Styled tables can be created using the `moonshine::table` component.

```php
<x-moonshine::table
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]"
/>
```

<a name="simple"></a>
## Simplified view

The `simple` parameter allows you to create a simplified table view.

```php
<x-moonshine::table
    :simple="true"
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]"
/>
```

<a name="sticky"></a>
## Sticky head

If the table contains a large number of elements, then you can fix the header when scrolling the table.

```php
<x-moonshine::table
    :sticky="true"
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]"
/>
```

<a name="notfound"></a>
## Missing elements

The `notfound` parameter allows you to display a message if there are no table elements.

```php
<x-moonshine::table
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :notfound="true"
/>
```

<a name="slots"></a>
## Slots

A table can be formed using slots.

```php
<x-moonshine::table>
    <x-slot:thead class="text-center">
        <th colspan="4">Header</th>
    </x-slot:thead>
    <x-slot:tbody>
        <tr>
            <th>1</th>
            <th>{{ fake()->firstName() }}</th>
            <th>{{ fake()->lastName() }}</th>
            <th>{{ fake()->safeEmail() }}</th>
        </tr>
        <tr>
            <th>2</th>
            <th>{{ fake()->firstName() }}</th>
            <th>{{ fake()->lastName() }}</th>
            <th>{{ fake()->safeEmail() }}</th>
        </tr>
        <tr>
            <th>3</th>
            <th>{{ fake()->firstName() }}</th>
            <th>{{ fake()->lastName() }}</th>
            <th>{{ fake()->safeEmail() }}</th>
        </tr>
    </x-slot:tbody>
    <x-slot:tfoot class="text-center">
        <td colspan="4">Footer</td>
    </x-slot:tfoot>
</x-moonshine::table>
```

<a name="styles"></a>
## Stylization

To style a table, there are predefined classes that can be used for `tr` / `td`.

Available classes:

- bgc-purple
- bgc-pink
- bgc-blue
- bgc-green
- bgc-yellow
- bgc-red
- bgc-gray
- bgc-primary
- bgc-secondary
- bgc-success
- bgc-warning
- bgc-error
- bgc-info


```php
<x-moonshine::table>
    <x-slot:thead class="bgc-secondary text-center">
        <th colspan="3">Header</th>
    </x-slot:thead>
    <x-slot:tbody>
        <tr>
            <th class="bgc-pink">{{ fake()->firstName() }}</th>
            <th class="bgc-gray">{{ fake()->lastName() }}</th>
            <th class="bgc-purple">{{ fake()->safeEmail() }}</th>
        </tr>
        <tr>
            <th class="bgc-green">{{ fake()->firstName() }}</th>
            <th class="bgc-red">{{ fake()->lastName() }}</th>
            <th class="bgc-yellow">{{ fake()->safeEmail() }}</th>
        </tr>
    </x-slot:tbody>
</x-moonshine::table>
```
