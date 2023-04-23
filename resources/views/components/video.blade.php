@props([
    'data' => []
])

@if(count($data))
    <ul class="mb-4 inline-flex gap-2 flex-wrap">
        @foreach($data as $video)
            <li class="space-y-2">
                <x-moonshine::modal :title="$video['title']">
                    <iframe
                        class="w-full aspect-video"
                        src="{{  $video['url'] }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                    <x-slot name="outerHtml">
                        <x-moonshine::link :filled="true" @click.prevent="toggleModal;">
                            <x-moonshine::icon icon="heroicons.play" size="4"/>
                            {{  $video['title'] }}
                        </x-moonshine::link>
                    </x-slot>
                </x-moonshine::modal>
            </li>
        @endforeach
    </ul>
@endif


