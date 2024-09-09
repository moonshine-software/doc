https://moonshine-laravel.com/docs/resource/getting-started/contribution?change-moonshine-locale=en

------
# Contribution Guide

  - [How can we help?](#how-can-we-help)
  - [Let's use](#lets-use)
  - [Where do we start?](#where-do-we-start)
  - [Pull requests](#pull-requests)
  - [Where to discuss the development?](#where-to-discuss-the-development)
  - [If you find a mistake](#if-you-find-a-mistake)
  - [Main branch](#main-branch)
  - [Coding style](#coding-style)
  - [Instructions for developers](#dev-guide)
  - [How do I make a pull request?](#pr)
  - [Any questions?](#any-questions)


<a name="how-can-we-help"></a>
## How can we help?

The community needs active users. You can help in many ways:

- Complement the code
- Front-end development
- Submit bug reports
- Help other users to understand the details
- Supplement documentation
- Promote the project

<a name="lets-use"></a>
## Let's use

- Blade
- TailwindCSS
- AlpineJs

<a name="where-do-we-start"></a>
## Where do we start?

There is an already functional product that is fully operational and testable. Functional doesn't mean great, so our job is to make it better.

<a name="pull-requests"></a>
## Pull requests

You can suggest new features or improvements for **MoonShine**! Errors and bugs - all this can be fixed and sent for revision. I am also glad to have new specialists for open source project development.

<a name="where-to-discuss-the-development"></a>
## Where to discuss the development?

A separate chat in telegram has been created for active participants of the project. If you are ready to take part in the development, then join - [MoonShine](https://t.me/MoonShine_Laravel).

<a name="if-you-find-a-mistake"></a>
## If you find a mistake

1. You have enough experience to offer a solution. I will be extremely glad to have your PR with a description of the error and an option to fix it.

2. If you don't know how to solve the problem - create GitHub issues and we will fix the problem soon.

> [!WARNING]
> It is important that your pr passes all platform tests and has a detailed description, so that it is clear to everyone involved in the development what exactly happened.

<a name="main-branch"></a>
## Main branch

At the moment, the main branch `2.x`

<a name="coding-style"></a>
## Coding style

**MoonShine** adheres to PSR-12 standard and PSR-4 autoload standard.

<a name="dev-guide"></a>
## Instructions for developers

1. Create a directory for the project and clone the demo.

```
git clone git@github.com:moonshine-software/demo-project.git .
```

2. Add the `packages` directory and run the command below.

```
cd packages && git clone git@github.com:moonshine-software/moonshine.git && cd moonshine && composer install && npm install
```

3. Go back to the project directory and in `composer.json` change the moonshine/moonshine dependency.

```
"moonshine/moonshine": "2.*.*-dev",
```

4.  Add in `composer.json`.

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

5. Create `.env` from `.env.example` (don't forget to create a database) and perform the installation below.

```
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan moonshine:user
php artisan serve
```
## Create something useful!

<a name="pr"></a>
## How do I make a pull request?

- Go to the MoonShine repository and click on "Fork"
- Make a git clone of your fork
- Create a new branch for your changes
- Do commits relying on convention [https://www.conventionalcommits.org](https://www.conventionalcommits.org)
- Make push your changes to your fork
- Go to the MoonShine repository again and click "New pull request"
- Comment in detail on the changes made in the "Description" field
- Expect a review!

<a name="any-questions"></a>
## Any questions?

My name is Danil! E-mail me [thecutcode@gmail.com](mailto:thecutcode@gmail.com)
