# Server-Driven UI (SDUI)

> [!WARNING]
> SDUI is currently in beta testing while we gather community feedback.

## Introduction

Server-Driven UI (SDUI) is a powerful approach to user interface development where the structure and content of the UI are defined by the server.
**MoonShine** provides built-in support for SDUI, allowing for the creation of dynamic and flexible interfaces without the need to update the client application.

## Structure of SDUI Response

In **MoonShine**, each UI component can be represented as a JSON structure that describes its type, states, and child components.
This structure is formed on the server and sent to the client for rendering.
An SDUI response in **MoonShine** typically includes the following key elements:

- `type` - component type,
- `components` - array of child components (if any),
- `states` - state of the component,
- `attributes` - HTML attributes of the component.

## Using SDUI

To use SDUI in **MoonShine**, send a GET request to the desired page with special headers.

### Basic structure request

```
GET /admin/dashboard HTTP/1.1
X-MS-Structure: true
```

Example response:

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

### Customizing the response

You can use additional headers to customize the response:

- Retrieve structure without states:
  ```
  X-MS-Structure: true
  X-MS-Without-States: true
  ```

  Example response:

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

- Retrieve only layout structure:
  ```
  X-MS-Structure: true
  X-MS-Only-Layout: true
  ```

- Retrieve page structure without layout:
  ```
  X-MS-Structure: true
  X-MS-Without-Layout: true
  ```

## Conclusion

SDUI in **MoonShine** provides a powerful and flexible way to create dynamic user interfaces.
It allows not only to define the structure and content of the UI on the server but also to precisely control the styles and attributes of each component,
ensuring a high degree of customization and adaptability of the interface.
