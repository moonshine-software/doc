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
        indexName: 'moonshine-laravel',
        placeholder: '{{ __('Search docs') }}',
        searchParameters: {
            facetFilters: ['language:{{ app()->getLocale() }}'],
        },
        translations: {
            button: {
                buttonText: '{{ __('Search') }}',
                buttonAriaLabel: '{{ __('Search') }}'
            },
            modal: {
                searchBox: {
                    resetButtonTitle: '{{ __('Clear the query') }}',
                    resetButtonAriaLabel: '{{ __('Clear the query') }}',
                    cancelButtonText: '{{ __('Cancel') }}',
                    cancelButtonAriaLabel: '{{ __('Cancel') }}'
                },
                startScreen: {
                    recentSearchesTitle: '{{ __('Recent') }}',
                    noRecentSearchesText: '{{ __('No recent searches') }}',
                    saveRecentSearchButtonTitle: '{{ __('Save this search') }}',
                    removeRecentSearchButtonTitle: '{{ __('Remove this search') }}',
                    favoriteSearchesTitle: '{{ __('Favorite') }}',
                    removeFavoriteSearchButtonTitle: '{{ __('Remove this search from favorites') }}'
                },
                errorScreen: {
                    titleText: '{{ __('Unable to fetch results') }}',
                    helpText: '{{ __('You might want to check your network connection.') }}'
                },
                footer: {
                    selectText: '{{ __('to select') }}',
                    selectKeyAriaLabel: '{{ __('Enter key') }}',
                    navigateText: '{{ __('to navigate') }}',
                    navigateUpKeyAriaLabel: '{{ __('Arrow up') }}',
                    navigateDownKeyAriaLabel: '{{ __('Arrow down') }}',
                    closeText: '{{ __('to close') }}',
                    closeKeyAriaLabel: '{{ __('Escape key') }}',
                    searchByText: '{{ __('Search by') }}'
                },
                noResultsScreen: {
                    noResultsText: '{{ __('No results for') }}',
                    suggestedQueryText: '{{ __('Try searching for') }}',
                    reportMissingResultsText: '{{ __('Believe this query should return results?') }}',
                    reportMissingResultsLinkText: '{{ __('Let us know.') }}'
                },
            },
        },
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

