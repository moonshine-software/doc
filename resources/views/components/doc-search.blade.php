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

<!-- Top.Mail.Ru counter -->
<script type="text/javascript">
  var _tmr = window._tmr || (window._tmr = []);
  _tmr.push({id: "3377023", type: "pageView", start: (new Date()).getTime()});
  (function (d, w, id) {
    if (d.getElementById(id)) return;
    var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
    ts.src = "https://top-fwz1.mail.ru/js/code.js";
    var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
    if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
  })(document, window, "tmr-code");
</script>
<noscript><div><img src="https://top-fwz1.mail.ru/counter?id=3377023;js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript>
<!-- /Top.Mail.Ru counter -->

