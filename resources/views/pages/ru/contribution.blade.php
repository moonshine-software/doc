<x-page title="Contribution Guide" :sectionMenu="[
     'Sections' => [
         ['url' => '#dev-guide', 'label' => 'Инструкция для разработчиков'],
         ['url' => '#pr', 'label' => 'Как сделать pull request'],
     ]
]">

<x-sub-title>Чем можно помогать?</x-sub-title>

<x-p>
    Сообществу нужны активные пользователи. Можно помочь разными формами:
</x-p>

<x-ul :items="[
'Дополнять код',
'Front-end разработка',
'Отправлять отчёты об ошибках',
'Помогать другим пользователям разобраться в деталях',
'Заниматься написанием документации',
'Заниматься популяризацией проекта'
]"></x-ul>

<x-sub-title>Используем</x-sub-title>

<x-ul :items="[
'Blade',
'Tailwindcss',
'AlpineJs',
]"></x-ul>

<x-sub-title>С чего мы начнем?</x-sub-title>

<x-p>
    Есть уже функционирующий продукт, полностью работоспособный и поддающийся тестированию. Работающий не означает великолепный,
    поэтому наша задача - сделать его лучше.
</x-p>

<x-sub-title>Pull requests</x-sub-title>

<x-p>
    Вы можете предложить новые функции или улучшения для <strong>MoonShine</strong>! Ошибки и баги - все это можно зафиксировать и отправить на доработку.
    Также я рад новым специалистам по развитию open source проекта.
</x-p>

<x-sub-title>Где обсуждать разработку?</x-sub-title>

<x-p>
    Для активных участников проекта создан отдельный чат в telegram. Если Вы готовы принять участие в разработке,
    то вступайте - <x-link link="https://t.me/laravel_chat/24568">MoonShine</x-link>.
</x-p>


<x-sub-title>Если нашли ошибку</x-sub-title>

<x-p>
    1. У вас достаточно опыта, чтобы предложить её решение.
    Я буду крайне рад вашему PR с описанием ошибки и вариантом её исправления.<br />
    2. Если не знаете, как решить проблему - создавайте GitHub issues, и в ближайшее время мы исправим эту проблему.

</x-p>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Важно, чтобы ваш pr прошел все тесты платформы и имел подробное описание,
    чтобы всем участникам разработки было понятно, что именно произошло.
</x-moonshine::alert>


<x-sub-title>Основная ветка</x-sub-title>

<x-p>
    На данный момент основная ветка <code>2.x</code>
</x-p>

<x-sub-title>Coding style</x-sub-title>

<x-p>
    <strong>MoonShine</strong> придерживается PSR-12 стандарта и PSR-4 autoload стандарта.
</x-p>

<x-sub-title id="dev-guide">Инструкция для разработчиков</x-sub-title>

<x-moonshine::badge color="green">1</x-moonshine::badge> Создайте директорию для проекта и клонируйте демо

<x-code language="shell">
    git clone git@github.com:moonshine-software/demo-project.git .
</x-code>

<x-moonshine::badge color="green">2</x-moonshine::badge> Добавьте директорию packages и выполните команду ниже

<x-code language="shell">
    cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
</x-code>

<x-moonshine::badge color="green">3</x-moonshine::badge> Вернитесь в директорию проекта и в composer.json измените зависимость moonshine/moonshine

<x-code language="shell">
    "moonshine/moonshine": "2.*.*-dev",
</x-code>

<x-moonshine::badge color="green">3</x-moonshine::badge> Добавьте в composer.json

<x-code language="shell">
"repositories": [
    {
        "type": "path",
        "url": "packages/moonshine",
        "options": {
            "versions": {
            "moonshine/moonshine": "2.*.*-dev"
        },
        "symlink": true
    }
]
</x-code>

<x-moonshine::badge color="green">5</x-moonshine::badge> Создайте .env из .env.example (не забудьте создать базу данных) и выполните установку ниже

<x-code language="shell">
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
</x-code>

<x-moonshine::badge color="green">#</x-moonshine::badge> Создайте что-нибудь полезное

<x-sub-title id="pr">Как делать pull request?</x-sub-title>

<x-ul :items="[
'Перейдите в MoonShine репозиторий и нажмите "Fork"',
'Сделайте git clone вашего fork',
'Создайте новую ветку для ваших изменений',
'Делайте commits, полагаясь на конвенцию <x-link link="https://www.conventionalcommits.org">https://www.conventionalcommits.org</x-link>',
'Сделайте push ваших изменений в ваш fork',
'Снова перейдите в репозиторий MoonShine и нажмите "New pull request"',
'Подробно прокомментируйте сделанные изменения в поле "Описание"',
'Ожидайте ревью!',
]"></x-ul>

<x-sub-title>Возникли вопросы?</x-sub-title>

<x-p>
    Меня зовут Данил! Пишите мне на почту <x-link link="mailto:thecutcode@gmail.com">thecutcode@gmail.com</x-link>
</x-p>

</x-page>
