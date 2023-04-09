<div class="text-sm">
    @lang('Extends')

    <x-moonshine::badge color="green">
        <a href="{{ $attributes->get('href') }}">{{ $slot }}</a>
    </x-moonshine::badge>

    <small class="block my-4">
        * @lang('has the same features')
    </small>
</div>

