@props([
    'src',
    'theme' => null,
])

<img
    src="{{ $src }}"
    alt="{{ $slot }}"
    @class([
        'w-100 rounded-md shadow-sm my-4',
        'dark:hidden' => $theme === 'light',
        'hidden dark:block' => $theme === 'dark'
    ])
/>
