# Экранирование отображаемого текста

- [Основы](#basics)
- [Локальные настройки](#local-settings)
- [Компоненты и создаваемые подписи](#components)
- [Blade-компоненты](#blade)
- [Переход с 4.x](#migration)

---

<a name="basics"></a>
## Основы

В **MoonShine** 5.x подписи, подсказки, префиксы, суффиксы и строки, возвращаемые callback-функциями полей `beforeRender()` и `afterRender()`, экранируются по умолчанию.
Например, подпись `<strong>Name</strong>` отображает теги как текст, а не делает подпись жирной.

Эти настройки независимы от экранирования значений полей.
Методы `escape()`, `unescape()` и `escapeOnApply()` сохраняют своё назначение; `unescape()` не разрешает HTML в подписи или подсказке.
Экранирование значения в popover при редактировании в режиме preview также не зависит от настроек подписи.

Методы `getLabel()` и `getHint()` возвращают исходные строки.
Экранирование отображаемого текста не меняет сериализованные подписи, имена столбцов, ключи значений карточки и экранирование HTML-атрибутов.

Глобальные значения по умолчанию описаны в разделе [Конфигурация](/docs/{{version}}/configuration#display-escaping).

<a name="local-settings"></a>
## Локальные настройки

Используйте метод для той части поля, которая должна отображать HTML.

| Отображаемый текст | Включить экранирование | Разрешить HTML |
| --- | --- | --- |
| Подпись | `escapeLabel()` | `unescapeLabel()` |
| Подсказка | `escapeHint()` | `unescapeHint()` |
| Префикс | `escapePrefix()` | `unescapePrefix()` |
| Суффикс | `escapeSuffix()` | `unescapeSuffix()` |
| Строка перед полем | `escapeBeforeRender()` | `unescapeBeforeRender()` |
| Строка после поля | `escapeAfterRender()` | `unescapeAfterRender()` |

Каждый метод `escape…()` принимает `bool $escape = true`.
Передача `false` равнозначна вызову соответствующего метода `unescape…()`.
Явная локальная настройка имеет приоритет над глобальной в обоих направлениях.
Например, `escapeLabel()` включает экранирование для одного поля, даже если глобально `escape_label` имеет значение `false`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel()
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint()
    ->prefix('<span>Prefix</span>')
    ->unescapePrefix()
    ->suffix('<span>Suffix</span>')
    ->unescapeSuffix()
    ->beforeRender(fn () => '<aside>Before</aside>')
    ->unescapeBeforeRender()
    ->afterRender(fn () => '<aside>After</aside>')
    ->unescapeAfterRender();
```

> [!WARNING]
> Разрешайте HTML только для доверенного содержимого. Отключение экранирования не очищает строку от опасной разметки.

Объекты, реализующие `Illuminate\Contracts\Support\Renderable`, например представления, возвращаемые из `beforeRender()` или `afterRender()`, сохраняют своё поведение при рендеринге.
Генерируемая разметка компонентов, включая обёртки полей `xIf()`, продолжает работать.

<a name="components"></a>
## Компоненты и создаваемые подписи

Компоненты с подписями, например `ActionButton`, `Link`, `Heading`, `Box`, `Collapse` и `Tab`, также поддерживают `escapeLabel()` и `unescapeLabel()`.
Элементы меню, теги запросов и обработчики используют ту же настройку подписи.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\ActionButton;

ActionButton::make('<strong>Open</strong>', '/articles')
    ->unescapeLabel();
```

Настройка подписи поля сохраняется в заголовках таблицы, переключателях выбора столбцов, карточках, созданных из полей, и заголовках отношений.
Кнопки отношений в режиме `modalMode()` наследуют эту настройку до применения `modifyButton`.
Кнопки обработчиков аналогично наследуют настройку обработчика до вызова `modifyButton()`, поэтому callback может её переопределить.

Для подписей в списке значений отдельной карточки используйте [Card::escapeValueLabels()](/docs/{{version}}/components/card#value-labels).

<a name="blade"></a>
## Blade-компоненты

Передайте логическое значение в `:escape-label`, чтобы переопределить глобальную настройку для подписи, выводимой напрямую через Blade.

```blade
<x-moonshine::action-button :label="$label" :escape-label="false" />
<x-moonshine::heading :label="$label" :escape-label="true" />
```

Соответствующие параметры: `:escape-hint` для `form.hint`, `:escape-prefix` для `form.input-extensions.prefix` и `:escape-suffix` для `form.input-extensions.ext`.
Существующие Blade-слоты остаются готовой HTML-разметкой; используйте синтаксис Blade `{{ $value }}`, чтобы экранировать динамический текст внутри слота.
При прямом вызове компонента `Link` подпись отображается, если слот пуст; явно заданный слот имеет приоритет.

<a name="migration"></a>
## Переход с 4.x

Проверьте подписи, подсказки, префиксы, суффиксы и callback-функции рендеринга полей, которые намеренно содержат HTML-строки.
Добавьте соответствующий метод `unescape…()`, чтобы сохранить отображение этого HTML в 5.x.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('<strong>Name</strong>', 'name')
    ->unescapeLabel() // [tl! add]
    ->hint('<a href="/help">Help</a>')
    ->unescapeHint(); // [tl! add]
```

Если приложению нужно другое поведение по умолчанию, измените соответствующую [глобальную настройку](/docs/{{version}}/configuration#display-escaping).
Используйте локальные переопределения, когда HTML должен отображаться только в отдельных строках.
