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
