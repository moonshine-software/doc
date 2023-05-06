<?php

return [
    'app_id' => env('ALGOLIA_APP_ID'),
    'admin_key' => env('ALGOLIA_ADMIN_KEY'),
    'frontend_key' => env('ALGOLIA_FRONTEND_KEY'),
    'doc' => [
        'id' => env('DOC_SEARCH_API_ID'),
        'key' => env('DOC_SEARCH_API_KEY'),
    ]
];
