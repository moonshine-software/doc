# Contribution Guide

- [How can we help?](#how-can-we-help)
- [What we use](#lets-use)
- [Where do we start?](#where-do-we-start)
- [Pull requests](#pull-requests)
- [Where to discuss the development?](#where-to-discuss-the-development)
- [If you find a mistake](#if-you-find-a-mistake)
- [Main branch](#main-branch)
- [Coding style](#coding-style)
- [Developer instructions](#dev-guide)
- [How to make a pull request?](#pr)
- [Any questions?](#any-questions)

---

<a name="how-can-we-help"></a>
## How can we help?

The community needs active users. You can help in many ways:

- Reporting bugs,
- Contributing to the code,
- Developing the frontend,
- Helping other users,
- Improving the documentation,
- Promoting the project.

<a name="lets-use"></a>
## What we use

- Blade,
- TailwindCSS,
- AlpineJs.

<a name="where-do-we-start"></a>
## Where do we start?

There is already a functional product that is fully operational and testable.
Functional does not mean perfect, so our task is to make it better.

<a name="pull-requests"></a>
## Pull requests

You can propose new features or improvements for **MoonShine**!
Bugs and issues can be fixed and submitted for review.
We also welcome new specialists to contribute to the open-source project.

<a name="where-to-discuss-the-development"></a>
## Where to discuss the development?

A separate chat in Telegram has been created for active project participants.
If you are ready to participate in development, join - [MoonShine](https://t.me/MoonShine_Laravel).

<a name="if-you-find-a-mistake"></a>
## If you find a mistake

1. You have enough experience to propose a solution. I would be very happy to receive your PR with a description of the issue and a proposed fix.
2. If you do not know how to solve the problem - create a GitHub issue, and we will fix the problem soon.

> [!WARNING]
> It is important that your PR passes all platform tests and includes a detailed description so that all development participants understand what exactly happened.

<a name="main-branch"></a>
## Main branch

Currently, the main branch is `4.x`.

<a name="coding-style"></a>
## Coding style

**MoonShine** adheres to the PSR-12 coding standard and the PSR-4 autoloading standard.

<a name="dev-guide"></a>
## Developer instructions

1. Create a directory for the project and clone the demo.

```shell
git clone git@github.com:moonshine-software/demo-project.git .
```

2. Add the `packages` directory and run the command below.

```shell
cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
```

3. Go back to the project directory and in `composer.json` change the dependency for moonshine/moonshine.

```
"moonshine/moonshine": "3.*.*-dev",
```

4. Add the following to `composer.json`.

```
"repositories": [
    {
        "type": "path",
        "url": "packages/moonshine",
        "options": {
            "versions": {
                "moonshine/moonshine": "3.*.*-dev"
            },
            "symlink": true
        }
    }
]
```

5. Create a `.env` file from `.env.example` (don't forget to create the database) and run the installation below.

```
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
```

**Create something useful!**

<a name="pr"></a>
## How to make a pull request?

- Go to the **MoonShine** repository and click "Fork",
- Clone your fork using git,
- Create a new branch for your changes,
- Commit your changes following the [conventional commits convention](https://www.conventionalcommits.org),
- Push your changes to your fork,
- Go back to the **MoonShine** repository and click "New pull request",
- Provide a detailed description of your changes in the "Description" field,
- Wait for a review!

<a name="any-questions"></a>
## Any questions?

My name is Danil! Feel free to email me at [thecutcode@gmail.com](mailto:thecutcode@gmail.com).
