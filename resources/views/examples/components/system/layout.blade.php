<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :class="$store.darkMode.on && 'dark'"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @moonShineAssets
</head>
<x-moonshine::layout> <!-- [tl! focus] -->
    //...
</x-moonshine::layout> <!-- [tl! focus] -->
</html>
