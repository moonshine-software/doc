# Server-Driven UI (SDUI)

## Введение

Server-Driven UI (SDUI) - это мощный подход к разработке пользовательских интерфейсов, где структура и содержимое UI определяются сервером.
MoonShine предоставляет встроенную поддержку SDUI, позволяя создавать динамические и гибкие интерфейсы без необходимости обновления клиентского приложения.

## Структура ответа SDUI

В MoonShine каждый UI-компонент может быть представлен в виде структуры JSON, которая описывает его тип, состояние и дочерние компоненты. Эта структура формируется на сервере и отправляется клиенту для рендеринга.
Ответ SDUI в MoonShine обычно содержит следующие ключевые элементы:

- `type`: Тип компонента
- `components`: Массив дочерних компонентов (если есть)
- `states`: Состояние компонента
- `attributes`: HTML атрибуты компонента

## Использование SDUI

Для использования SDUI в MoonShine, отправьте GET-запрос к нужной странице с специальными заголовками.

### Базовый запрос структуры

```http
GET /admin/dashboard HTTP/1.1
X-MS-Structure: true
```

Пример ответа:

```json
{
  "type": "Dashboard",
  "components": [
    {
      "type": "Card",
      "components": [
        {
          "type": "Heading",
          "states": {
            "level": 1,
            "content": "Welcome to Dashboard"
          },
          "attributes": {
            "class": ["text-2xl", "font-bold"],
            "id": "dashboard-heading"
          }
        },
        {
          "type": "Text",
          "states": {
            "content": "Here's an overview of your system."
          },
          "attributes": {
            "class": ["mt-2", "text-gray-600"]
          }
        }
      ],
      "states": {
        "title": "Dashboard Overview"
      },
      "attributes": {
        "class": ["bg-white", "shadow", "rounded-lg"],
        "data-card-id": "dashboard-overview"
      }
    }
  ],
  "states": {
    "title": "Admin Dashboard"
  },
  "attributes": {
    "class": ["container", "mx-auto", "py-6"]
  }
}
```

### Настройка ответа

Вы можете использовать дополнительные заголовки для настройки ответа:

- Получение структуры без состояний:
  ```http
  X-MS-Structure: true
  X-MS-Without-States: true
  ```

  Пример ответа:

  ```json
  {
    "type": "Dashboard",
    "components": [
      {
        "type": "Card",
        "components": [
          {
            "type": "Heading",
            "attributes": {
              "class": ["text-2xl", "font-bold"],
              "id": "dashboard-heading"
            }
          },
          {
            "type": "Text",
            "attributes": {
              "class": ["mt-2", "text-gray-600"]
            }
          }
        ],
        "attributes": {
          "class": ["bg-white", "shadow", "rounded-lg"],
          "data-card-id": "dashboard-overview"
        }
      }
    ],
    "attributes": {
      "class": ["container", "mx-auto", "py-6"]
    }
  }
  ```

- Получение только структуры layout:
  ```http
  X-MS-Structure: true
  X-MS-Only-Layout: true
  ```

- Получение структуры страницы без layout:
  ```http
  X-MS-Structure: true
  X-MS-Without-Layout: true
  ```

## Заключение

SDUI в MoonShine, предоставляет мощный и гибкий способ создания динамических пользовательских интерфейсов. Это позволяет не только определять структуру и содержание UI на сервере, но и точно контролировать стили и атрибуты каждого компонента, обеспечивая высокую степень кастомизации и адаптивности интерфейса.
