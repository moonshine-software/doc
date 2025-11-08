[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md)
[![ru](https://img.shields.io/badge/lang-ru-red.svg)](#)

# Типография

- [Заголовок](#title)
- [Навигация](#navigations)
- [Разделитель](#divider)
- [Заголовок подраздела](#subtitle)
- [Контент](#content)
- [Примеры кода](#code)
- [Списки](#list)
- [Вкладки](#tabs)
- [Уведомления](#alert)
- [Изображения](#images)
- [Shortcodes](#shortcodes)

___

В **MoonShine** мы считаем, что хорошая документация — это не просто дополнение к продукту, а его фундамент.
Именно она помогает новичкам не бояться старта, а опытным разработчикам — работать быстро и эффективно.

Мы стремимся писать понятным, живым языком, избегая внутреннего жаргона и сложных формулировок.
Каждый раздел мы стараемся подкреплять реальными кейсами и иллюстрациями — чтобы всё работало не только в теории, но и в жизни.

Да, это непросто. Хорошая документация требует времени, внимания к деталям и постоянной доработки.
Но мы не ищем лёгких путей — мы работаем над тем, чтобы каждый следующий релиз становился чуть понятнее, доступнее и полезнее для всех, кто работает с MoonShine.

<a name="title"></a>
## Заголовок

Название раздела является первым и обязательным элементом страницы.

```html
# Title
```

<a name="navigations"></a>
## Навигация

Если раздел большой, то его необходимо разбить на подразделы и создать навигационное меню.

Навигационное меню представляет собой список со ссылками на подраздел. У заголовков подраздела необходимо указать якорь.

```html
- [Subtitle 1](#subtitle-1)
- [Subtitle 2](#subtitle-2)
```

> [!NOTE]
> Для разделения слов в ссылках используется `kebab-case`.

<a name="divider"></a>
## Разделитель

После навигации необходимо указать разделитель.

```
---
```

<a name="subtitle"></a>
## Заголовок подраздела

Заголовки подразделов указываются со ссылкой, для удобного копирования ссылки на конкретный раздел документации.

```html
## Subtitle
```

Если используется [Навигация](#navigations), то необходимо перед заголовком добавить якорь:

```html
<a name="anchor"></a>
## Subtitle
```

Для названия первого пункта чаще всего необходимо использовать название `Основы`, вместо похожих `Начало`, `Введение` и др.

```html
<a name="basics"></a>
## Основы
```

Если описывается компонент, который наследуется от другого класса, и в навигации есть пункт `Основы`,
то описание наследования пишем строго после этого пункта.

```html
<a name="basics"></a>
## Основы

Наследует [Select](/docs/{{version}}/fields/select).

\* имеет те же возможности.

```

Если базовые методы описываются в другом разделе документации, то пишем так

```html
<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).
```

<a name="content"></a>
## Контент

Кроме тегов `markdown` допускается использование `html-тегов`.

> [!WARNING]
> Все предложения должны заканчиваться точкой.

Желательно построчно синхронизировать тексты в **ru** и **en** версиях разделов.

Для выделения имени собственного используются двойные звёздочки `**`, например, `**MoonShine**`.

<a name="code"></a>
## Примеры кода

- для оформления методов, классов и тд. используется одиночный апостроф ``` ` ```,
- названия методов должны заканчиваться скобками, например: `setLabel()`,
- для оформления блоков кода используется тройные апострофы ` ``` ` с указанием языка программирования и начинаться блок должен с новой строки,
- для всех классов, используемых в примерах, необходимо указать use в алфавитном порядке и обернуть их в collapse.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('Title')
```
или
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\UI\Fields\Text; // [tl! collapse:end]

Text::make('Title')
```

Для подсветки изменений в коде можно использовать специальные аннотации.

```php
MenuItem::make('Settings', SettingResource::class, 'heroicons.outline.adjustments-vertical') // [tl! remove]
MenuItem::make(SettingResource::class, 'Settings', 'adjustments-vertical') // [tl! add]
```
или
```php
MenuItem::make('Settings', SettingResource::class, 'heroicons.outline.adjustments-vertical') // [tl! --]
MenuItem::make(SettingResource::class, 'Settings', 'adjustments-vertical') // [tl! ++]
```

Указать название файла или класса, к которому относится код, можно через параметр `filename`.

```
```php filename:config/moonshine.php
```

> [!WARNING]
> Использование пробелов в названиях недопустимо.

<a name="list"></a>
## Списки

```html
- элементы списка заканчивается запятой,
- после последнего элемента ставится точка.
```

<a name="tabs"></a>
## Вкладки

```
~~~tabs

tab: Tab 1
Content tab 1

tab: Tab 2
Content tab 2

~~~
```

<a name="alert"></a>
## Уведомления

В документации используется несколько типов уведомлений:

```
> [!NOTE]
> Простое уведомление.
```

```
> [!WARNING]
> Предупреждение.
```

```
> [!TIP]
> Советы.
```

<a name="images"></a>
## Изображения

Изображения добавляем в директорию `/resources/screenshots`.

Ссылку указываем - https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/filename.png

Пример:

```
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png)
```

Для показа изображения в темной или светлой теме, необходимо к ссылке добавить hash тег `#light` или `#dark`.

```
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png#light)
![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_dark.png#dark)
```

<a name="shortcodes"></a>
## Shortcodes

### Include

Шорт-код `include` подключает markdown и отображает его, а затем пропускает содержимое через sprintf,
поэтому все параметры после пути к markdown будут переданы в том же порядке.

```md
@include($path_to_md, ...$params)
```

#### Пример файла

`_includes/my-partial.md`

```md
## Hello world
%s - %s
```

#### Пример использования

`_includes/test.md`

```md
<a name="what-is-moonshine"></a>
## What is MoonShine

@include('_includes/test', 'test', 3)
```

#### Под капотом

```php
sprintf('markdown', 'test', 3);
```

#### Результат

```html
<h2>What is MoonShine</h2>
test - 3
```
