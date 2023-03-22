@if(!isset($theme))
    <img
        src="{{ $src }}"
        alt="{{ $slot }}"
        class="w-100 rounded-md shadow-sm my-4"
    />
@elseif($theme == 'dark')
    <img
        src="{{ $src }}"
        alt="{{ $slot }}"
        x-show="$store.darkMode.on"
        style="display: none"
        class="w-100 rounded-md shadow-sm my-4"
    />
@else()
    <img
        src="{{ $src }}"
        alt="{{ $slot }}"
        x-show="!$store.darkMode.on"
        style="display: none"
        class="w-100 rounded-md shadow-sm my-4"
    />
@endif
