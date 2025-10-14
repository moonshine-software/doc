[![en](https://img.shields.io/badge/lang-en-red.svg)](#)
[![ru](https://img.shields.io/badge/lang-ru-red.svg)](README.ru.md)

# Typography

- [Title](#title)
- [Navigation](#navigations)
- [Divider](#divider)
- [Subtitle](#subtitle)
- [Content](#content)
- [Code Example](#code)
- [Lists](#list)
- [Tabs](#tabs)
- [Alerts](#alert)
- [Images](#images)
- [Shortcodes](#shortcodes)

___

At MoonShine, we believe that great documentation isn’t just a nice-to-have — it’s the foundation of our product. It’s what helps beginners get started with confidence and allows experienced developers to move faster and smarter.

We aim to write in clear, simple language, avoiding internal jargon and overly complex explanations. Whenever possible, we highlight each section with real-world use cases and screenshots — because theory is great, but practical examples are better.

That said, great documentation is hard. It takes time, care, and ongoing effort. But we’re committed to the process. With every release, we strive to make our docs a little clearer, more helpful, and more accessible for everyone building with MoonShine.

<a name="title"></a>
## Title

The section title is the first and mandatory element of the page.

```html
# Title
```

<a name="navigations"></a>
## Navigation

If the section is large, it should be divided into subsections and a navigation menu should be created.

The navigation menu is a list with links to the subsection. The subsection headings should have an anchor specified.

```html
- [Subtitle 1](#subtitle-1)
- [Subtitle 2](#subtitle-2)
```

> [!NOTE]
> `Kebab-case` is used to separate words in links.

<a name="divider"></a>
## Divider

After navigation (content), a divider should be specified.

```
---
```

<a name="subtitle"></a>
## Subtitle

Subsection headings are specified with a link for easy copying of the link to a specific section of the documentation.

```html
## Subtitle
```

If [Navigation](#navigations) is used, an anchor should be added before the heading:

```html
<a name="anchor"></a>
## Subtitle
```

For the name of the first item, it is often necessary to use the name `Basics`, instead of similar `Start`, `Introduction`, etc.

```html
<a name="basics"></a>
## Basics
```

If a component is described that inherits from another class, and there is a `Basics` item in the navigation,
then the description of inheritance is written strictly after this item.

```html
<a name="basics"></a>
## Basics

Inherits from [Select](/docs/{{version}}/fields/select).

\* has the same capabilities.

```

If the basic methods are described in another section of the documentation, then write it like this

```html
<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).
```

<a name="content"></a>
## Content

In addition to `markdown` tags, `html-tags` are allowed.

> [!WARNING]
> All sentences should end with a period.

It is desirable to synchronize the texts in the **ru** and **en** versions of the sections line by line.

Double asterisks `**` are used to format proper name, for example, `**MoonShine**`.

<a name="code"></a>
## Code Example

- single apostrophe ``` ` ``` is used to format methods, classes, etc.,
- method names should end with parentheses, for example: `setLabel()`,
- triple apostrophes ` ``` ` with the programming language specified are used to format code blocks, and the block should start on a new line,
- for all classes used in examples, you need to specify use in alphabetical order and wrap them in collapse.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('Title')
```
or
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\UI\Fields\Text; // [tl! collapse:end]

Text::make('Title')
```

If you need to specify what changes in the code, then you can use a special design.

```php
MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical') // [tl! remove]
MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical') // [tl! add]
```
or
```php
MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical') // [tl! --]
MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical') // [tl! ++]
```

You can specify the name of the file or class to which the code belongs using the `filename` parameter.

```
```php filename:config/moonshine.php
```

> [!WARNING]
> Spaces in names are not allowed.

<a name="list"></a>
## Lists

```html
- list items end with a comma,
- a dot is placed after the last one.
```

<a name="tabs"></a>
## Tabs

```
~~~tabs

tab: Tab 1
Content tab 1

tab: Tab 2
Content tab 2

~~~
```

<a name="alert"></a>
## Alerts

The documentation uses several types of alerts:

```
> [!NOTE]
> Simple notification.
```

```
> [!WARNING]
> Warning.
```

```
> [!TIP]
> Tips.
```

<a name="images"></a>
## Images

Images are added to the `/resources/screenshots` directory.

The link is specified - https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/filename.png

Example:

```
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png)
```

To show the image in a dark or light themes, you must add to the link hashtag `#light` or `#dark`.

```
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png#light)
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_dark.png#dark)
```

<a name="shortcodes"></a>
## Shortcodes

### Include

The shortcode `include` connects markdown and renders it, and then runs the content through sprintf, so all parameters after the path to markdown will be passed in the same order.

```md
@include($path_to_md, ...$params)
```

#### Markdown partial example content

`_includes/my-partial.md`

```md
## Hello world
%s - %s
```

#### Usage example

`_includes/test.md`

```md
<a name="what-is-moonshine"></a>
## What is MoonShine

@include('_includes/test', 'test', 3)
```

#### Under the hood

```php
sprintf('markdown', 'test', 3);
```

#### Result

```html
<h2>What is MoonShine</h2>
test - 3
```
