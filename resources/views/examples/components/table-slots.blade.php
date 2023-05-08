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
