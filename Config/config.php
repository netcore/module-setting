<?php

return [
    // Module name
    'name' => 'Setting',

    // Cache key
    'cache_key' => env('NETCORE_SETTING_CACHE_KEY', 'settings'),

    // Upload path
    'upload_path' => env('NETCORE_SETTING_UPLOAD_PATH', '/uploads/settings')
];
