@props([
    'src',
    'theme' => null,
])

<style>
    .dark .dark\:block {display: block}
    .dark .dark\:hidden {display: none}
</style>

<img
    src="{{ $src }}"
    alt="{{ $slot }}"
    @class([
        'w-100 rounded-md shadow-sm my-4',
        'dark:hidden' => $theme === 'light',
        'hidden dark:block' => $theme === 'dark'
    ])
/>
