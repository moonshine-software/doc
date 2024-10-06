# Руководство по внесению вклада

- [Как мы можем помочь?](#how-can-we-help)
- [Что мы используем](#lets-use)
- [С чего начать?](#where-do-we-start)
- [Pull requests](#pull-requests)
- [Где обсуждать разработку?](#where-to-discuss-the-development)
- [Если вы нашли ошибку](#if-you-find-a-mistake)
- [Основная ветка](#main-branch)
- [Стиль кодирования](#coding-style)
- [Инструкции для разработчиков](#dev-guide)
- [Как сделать pull request?](#pr)
- [Есть вопросы?](#any-questions)

---

<a name="how-can-we-help"></a>
## Как мы можем помочь?

Сообществу нужны активные пользователи. Вы можете помочь многими способами:

- Дополнять код;
- Разрабатывать фронтенд;
- Сообщать об ошибках;
- Помогать другим пользователям разобраться в деталях;
- Дополнять документацию;
- Продвигать проект.

<a name="lets-use"></a>
## Что мы используем

- Blade;
- TailwindCSS;
- AlpineJs.

<a name="where-do-we-start"></a>
## С чего начать?

Существует уже функциональный продукт, который полностью работоспособен и тестируем. Функциональный не значит идеальный, поэтому наша задача - сделать его лучше.

<a name="pull-requests"></a>
## Pull requests

Вы можете предлагать новые функции или улучшения для **MoonShine**! Ошибки и баги - все это можно исправить и отправить на доработку. Я также рад новым специалистам для разработки проекта с открытым исходным кодом.

<a name="where-to-discuss-the-development"></a>
## Где обсуждать разработку?

Для активных участников проекта создан отдельный чат в телеграме. Если вы готовы принять участие в разработке, то присоединяйтесь - [MoonShine](https://t.me/MoonShine_Laravel).

<a name="if-you-find-a-mistake"></a>
## Если вы нашли ошибку

1. У вас достаточно опыта, чтобы предложить решение. Я буду крайне рад вашему PR с описанием ошибки и вариантом ее исправления.

2. Если вы не знаете, как решить проблему - создайте GitHub issues, и мы скоро исправим проблему.

> [!WARNING]
> Важно, чтобы ваш PR прошел все тесты платформы и имел подробное описание, чтобы всем участникам разработки было понятно, что именно произошло.

<a name="main-branch"></a>
## Основная ветка

На данный момент основная ветка `2.x`

<a name="coding-style"></a>
## Стиль кодирования

**MoonShine** придерживается стандарта PSR-12 и стандарта автозагрузки PSR-4.

<a name="dev-guide"></a>
## Инструкции для разработчиков

1. Создайте директорию для проекта и клонируйте демо.

```
git clone git@github.com:moonshine-software/demo-project.git .
```

2. Добавьте директорию `packages` и выполните команду ниже.

```
cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
```

3. Вернитесь в директорию проекта и в `composer.json` измените зависимость moonshine/moonshine.

```
"moonshine/moonshine": "2.*.*-dev",
```

4. Добавьте в `composer.json`.

```
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
    }
]
```

5. Создайте `.env` из `.env.example` (не забудьте создать базу данных) и выполните установку ниже.

```
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
```
## Создавайте что-нибудь полезное!

<a name="pr"></a>
## Как сделать pull request?

- Перейдите в репозиторий MoonShine и нажмите на "Fork",
- Сделайте git clone вашего форка,
- Создайте новую ветку для ваших изменений,
- Делайте коммиты, опираясь на конвенцию [https://www.conventionalcommits.org](https://www.conventionalcommits.org),
- Сделайте push ваших изменений в ваш форк,
- Снова перейдите в репозиторий MoonShine и нажмите "New pull request",
- Подробно прокомментируйте внесенные изменения в поле "Description",
- Ожидайте ревью!

<a name="any-questions"></a>
## Есть вопросы?

Меня зовут Данил! Пишите мне на почту [thecutcode@gmail.com](mailto:thecutcode@gmail.com)
