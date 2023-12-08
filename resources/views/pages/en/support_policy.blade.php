<x-page>
    <x-moonshine::table>
        <x-slot:thead>
            <th>Version</th>
            <th>PHP</th>
            <th>Laravel</th>
            <th>Release</th>
            <th>Bug Fixes Until</th>
            <th>Security Fixes Until</th>
        </x-slot:thead>
        <x-slot:tbody>
            <tr class="bgc-red">
                <td>1</td>
                <td>7.3 - 8.0</td>
                <td>8 - 9</td>
                <td>June 6th, 2022</td>
                <td>April 3rd, 2023</td>
                <td>April 3rd, 2023</td>
            </tr>
            <tr class="bgc-yellow">
                <td>1.5</td>
                <td>8.0 - 8.2</td>
                <td>9 - 10</td>
                <td>April 3rd, 2023</td>
                <td>November 1st, 2023</td>
                <td>November 1st, 2024</td>
            </tr>
            <tr>
                <td>2.0</td>
                <td>8.1 - 8.2</td>
                <td>10</td>
                <td>November 1st, 2023</td>
                <td>November 1st, 2024</td>
                <td>November 1st, 2025</td>
            </tr>
            <tr>
                <td>3.0</td>
                <td>8.2</td>
                <td>11</td>
                <td>November 1st, 2024</td>
                <td>November 1st, 2025</td>
                <td>November 1st, 2026</td>
            </tr>
        </x-slot:tbody>
    </x-moonshine::table>

    <x-moonshine::badge color="red">End of life</x-moonshine::badge>
    <x-moonshine::badge color="yellow">Security fixes only</x-moonshine::badge>
</x-page>
