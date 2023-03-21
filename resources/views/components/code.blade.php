<x-moonshine::box :dark="true" class="my-4">
<pre>
@if(isset($file))
<x-torchlight-code theme="moonlight-ii" language='{{ $language }}' contents="{{ base_path($file) }}" />
@else
<x-torchlight-code theme="moonlight-ii" language='{{ $language }}'>{!! $slot !!}</x-torchlight-code>
@endif
</pre>
</x-moonshine::box>

