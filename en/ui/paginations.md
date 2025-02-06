# Paginations

- [Basics](#basics)
- [Simplified pagination](#simplified-pagination)

---

<a name="basics"></a>
## Basics

The `moonshine::pagination` component allows you to create stylized pagination across pages.To do this, add a component to the blade view of the pagination.

```bladehtml
<x-moonshine::pagination
    :paginator="$paginator"
    :elements="$elements"
/>
```

<a name="simple"></a>
## Simplified pagination

The `simple` parameter with the value `TRUE` allows you to display pagination in a simplified form.

```bladehtml
<x-moonshine::pagination
    :paginator="$paginator"
    :elements="$elements"
    :simple="true"
/>
```
