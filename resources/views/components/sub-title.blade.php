@props([
    'hashtag' => '#'
])
<h2 {{ $attributes }} class="mb-4 mt-8 text-xl font-bold">
    <a
        href="{{ $attributes['id'] ? '#' . $attributes['id'] : '' }}"
        @click.prevent="
            scrollToSection('{{ $attributes['id'] ? '#' . $attributes['id'] : '' }}')
            navigator.clipboard.writeText(window.location.href)
            $dispatch('toast', {type: 'success', text: '{{ __('Link copied') }}'})
        "
        title="{{ __('Copy to clipboard') }}"
    >
        @include('moonshine::ui.badge', [
            'value' => $hashtag,
            'color' => 'purple'
        ])
    </a>
    <a
        href="{{ $attributes['id'] ? '#' . $attributes['id'] : '' }}"
        @click.prevent="scrollToSection('{{ $attributes['id'] ? '#' . $attributes['id'] : '' }}')"
    >
        {{ $slot }}
    </a>
</h2>
