<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"
/>

<script rel="preconnect"
        src="https://cdn.jsdelivr.net/npm/@docsearch/js@3"
        crossorigin
>
</script>

<div id="doc-search"></div>

<script type="text/javascript">
    docsearch({
        appId: '{{ config('algolia.doc.id') }}',
        apiKey: '{{ config('algolia.doc.key')  }}',
        indexName: 'moonshine',
        container: '#doc-search',
        debug: false,
    });
</script>

<style>
    .DocSearch-Form {
        box-shadow: #7843E9 0 0 0 2px inset!important;
    }
    .DocSearch-Hit-source, .DocSearch-MagnifierLabel {
        color: #7843E9!important;
    }
    .DocSearch-Input:focus {
        box-shadow: none!important;
    }
    .DocSearch-Hit[aria-selected='true'] a {
        background: #7843E9!important;
    }
</style>

