<span x-data="tooltip('Tooltip content 1', {placement: 'top'})"><!-- [tl! focus:start] -->
    <a class="text-purple font-semibold">Trigger 1</a>
</span><!-- [tl! focus:end] -->
or
<span
    x-data="tooltip"
    data-tippy-content="Tooltip content 2"
    data-tippy-placement="right">
    <a class="text-purple font-semibold">Trigger 2</a>
</span><!-- [tl! focus:-5] -->
