<x-page title="Contribution Guide" :sectionMenu="null">

<x-sub-title>Чем можно помогать?</x-sub-title>

<x-p>
    Сообществу нужны активные пользователи. Можно помочь разными формами
</x-p>

<x-ul :items="[
'Дополнять код',
'Front-end разработка',
'Отправлять отчёты об ошибках',
'Помогать другим пользователям разобраться в деталях',
'Заниматься написанием документации',
'Заниматься пропагандой'
]"></x-ul>

<x-sub-title>С чего мы начнем?</x-sub-title>

<x-p>
Есть уже функционирующий продукт, полностью работоспособный и поддающийся тестированию. Работающий не означает великолепный поэтому задача сделать проект именно таким.
</x-p>

<x-sub-title>Pull requests</x-sub-title>

<x-p>
    Вы можете предложить новые функции или улучшения для moonShine! Ошибки и баги - все это можно зафиксировать и отправить на доработку.
    Также я рад новым специалистам по развитию open source проекта
</x-p>

<x-sub-title>Где обсуждать разработку?</x-sub-title>

<x-p>
    Для активных участников проекта создан отдельный закрытый чат в telegram, если Вы готовы принять участие в разработке, то напишите мне <a class="underline" href="https://t.me/leeto_telegram">@leeto_telegram</a> и я отправлю приглашение.
</x-p>


<x-sub-title>Если нашли ошибку</x-sub-title>

<x-p>
    1. У вас достаточно опыта чтобы предложить её решение.
    Я буду крайне рад вашему PR с описанием ошибки и вариантом её исправления.
    <br>
    2. Если не знаете как решить проблему - создавайте github issues и в ближайшее время мы исправим эту проблему.

    <div class="text-sm my-4">* Важно чтобы ваш pr прошел все тесты платформы и имел подробное описание, чтобы всем участникам разработки было понятно что именно произошло.</div>
</x-p>

<x-sub-title>Основная ветка</x-sub-title>

<x-p>
    На данный момент основная ветка <code>1.x</code>
</x-p>

<x-sub-title>Coding style</x-sub-title>

<x-p>
    MoonShine придерживается PSR-2 стандарта и PSR-4 autoload стандарта.
</x-p>

<x-sub-title>Цели</x-sub-title>

<table class="border-collapse table-fixed w-full text-sm my-4">
    <thead>
        <tr>
            <th class="border-b border-r border-purple font-medium p-4 pl-8 pt-0 pb-3 text-black text-left">Мажорные</th>
            <th class="border-b border-purple font-medium p-4 pl-8 pt-0 pb-3 text-black text-left">Минорные</th>
        </tr>
    </thead>

    <tbody class="bg-white">
        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Разгрузка больших классов</td>
            <td class="border-b border-purple p-4 pl-8 text-black">Документация кода</td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Рефакторинг</td>
            <td class="border-b border-purple p-4 pl-8 text-black">Закончить dark mode</td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Покрытие тестами до 60%</td>
            <td class="border-b border-purple p-4 pl-8 text-black">Компиляция assets во время установки</td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Удаление лишних трейтов</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">HasMany с возможностью добавить дочерний HasMany</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Переход от alpinejs к vue</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Блоки с аналитикой</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Готовые фильтр наборы</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>

        <tr>
            <td class="border-b border-r border-purple p-4 pl-8 text-black">Реализация расширений</td>
            <td class="border-b border-purple p-4 pl-8 text-black"></td>
        </tr>
    </tbody>
</table>

<x-sub-title>Возникли вопросы?</x-sub-title>

<x-p>
    Меня зовут, Данил! Пишите мне на почту <a href="mailto:info@cutcode.ru">info@cutcode.ru</a>
</x-p>

</x-page>