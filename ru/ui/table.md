# Таблица

- [Основы](#basics)
- [Упрощенный вид](#simple)
- [Закрепленная шапка](#sticky)
- [Отсутствующие элементы](#notfound)
- [Слоты](#slots)
- [Стилизация](#styles)

---

<a name="basics"></a>
## Основы

Стилизованные таблицы можно создавать с помощью компонента `moonshine::table`.

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
## Упрощенный вид

Параметр `simple` позволяет создать упрощенный вид таблицы.

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
## Закрепленная шапка

Если таблица содержит большое количество элементов, то можно зафиксировать шапку при прокрутке таблицы.

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
## Отсутствующие элементы

Параметр `notfound` позволяет отобразить сообщение, если элементы таблицы отсутствуют.

```php
<x-moonshine::table
    :columns="[
        '#', 'First', 'Last', 'Email'
    ]"
    :notfound="true"
/>
```

<a name="slots"></a>
## Слоты

Таблицу можно формировать с помощью слотов.

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
## Стилизация

Для стилизации таблицы есть предопределенные классы, которые можно использовать для `tr` / `td`.

Доступные классы:

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
