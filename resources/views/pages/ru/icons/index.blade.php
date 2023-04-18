<x-page title="Icons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#system', 'label' => 'Системные иконки'],
        ['url' => '#custom', 'label' => 'Кастомные иконки']
    ]
]">

<x-p>
    Для всех сущностей, в которых есть метод <code>->icon()</code>,
    можно воспользоваться одним из предложенных наборов иконок или создать свой набор
</x-p>

<x-sub-title id="system">Системные иконки</x-sub-title>

<x-code language="php">
    ->icon('add') // [tl! focus]
</x-code>

<x-icon-list
    pattern="../vendor/moonshine/moonshine/resources/views/ui/icons/*.blade.php"
/>

<x-sub-title id="custom">Кастомные иконки</x-sub-title>

<x-p>
    Также есть возможность создать blade файл с вашей кастомной иконкой. Для этого необходимо в <code>resources/views/vendor/moonshine/shared/icons</code>
    создать blade файл как пример my-icon.blade.php с отображением иконки внутри (например код svg)
    и далее указать <code>icon('my-icon')</code>
</x-p>

</x-page>
