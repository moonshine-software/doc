<x-recipe id="make-component" title="{{ $title ?? 'Recipe' }}">

<x-p>
    We also recommend that you familiarize yourself with AlpineJs and use the full power of this js framework.
</x-p>

<x-p>
    You can use its reactivity, let's see how to conveniently create a component.
</x-p>

<x-code language="html">
<div x-data="myComponent">
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("myComponent", () => ({
            init() {

            },
        }))
    })
</script>
</x-code>

</x-recipe>
