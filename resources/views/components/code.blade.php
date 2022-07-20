<div class="relative">

<pre class="bg-transparent p-0 m-0 my-4">
<x-torchlight-code language='{{ $language }}' class="text-sm rounded" theme="deep-purple">
{!! $slot !!}
</x-torchlight-code>
</pre>


<div x-data="{}" class="absolute top-2 right-2 text-white">
    <button type="button" x-clipboard.raw="{{ str_replace('"', "'", $slot) }}" class="md:block hidden">
        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path><path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
        </svg>
    </button>
</div>
</div>

