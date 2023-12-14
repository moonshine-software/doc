<x-recipe id="make-component" title="{{ $title ?? 'Рецепт' }}">

<x-p>
    Также рекомендуем ознакомиться с AlpineJs и использовать всю мощь этого js фреймворка.
</x-p>

<x-p>
    Вы можете использовать его реактивность, давайте посмотрим как удобно создать компонент.
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
