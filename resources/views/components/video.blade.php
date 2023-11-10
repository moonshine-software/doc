@props([
    'data' => []
])

@if(count($data))
    <ul class="mb-4 inline-flex gap-2 flex-wrap">
        @foreach($data as $video)
            <li class="space-y-2">
                <x-moonshine::modal :title="$video['title']">
                    <div x-init="$watch('open', () => stopVideo('.modal-video'))">
                        <iframe
                            class="w-full aspect-video modal-video"
                            src="{{ $video['url'] }}{{ str($video['url'])->contains('?') ? '&' : '?' }}enablejsapi=1&rel=0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <x-slot name="outerHtml">
                        <x-moonshine::link-button :filled="true">
                            <x-moonshine::icon icon="heroicons.play" size="4"/>
                            {{  $video['title'] }}
                        </x-moonshine::link-button>
                    </x-slot>
                </x-moonshine::modal>
            </li>
        @endforeach
    </ul>
@endif


