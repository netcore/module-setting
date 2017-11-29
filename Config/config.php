<?php

return [
    // Cache key
    'cache_key'        => 'settings',

    // Upload path
    'upload_path'      => '/uploads/settings',

    // Default settings to seed
    'default_settings' => [
        [
            'group' => 'scripts',
            'name'  => 'Google Analytics API key',
            'key'   => 'google_analytics_api_key',
            'type'  => 'text',
        ],
        [
            'group' => 'scripts',
            'name'  => 'Google Analytics client ID',
            'key'   => 'google_analytics_client_id',
            'type'  => 'text',
        ],
        [
            'group' => 'scripts',
            'name'  => 'Google Analytics script',
            'key'   => 'google_analytics_script',
            'type'  => 'textarea',
        ],
        [
            'group' => 'scripts',
            'name'  => 'Custom javascripts',
            'key'   => 'custom_js',
            'type'  => 'textarea',
        ],
        [
            'group' => 'scripts',
            'name'  => 'Custom styles',
            'key'   => 'custom_css',
            'type'  => 'textarea'
        ],

        [
            'group' => 'seo',
            'name'  => 'Meta keywords',
            'key'   => 'meta_keywords',
            'type'  => 'textarea',
        ],
        [
            'group' => 'seo',
            'name'  => 'Meta description',
            'key'   => 'meta_description',
            'type'  => 'textarea',
        ],

        // Facebook OG tags
        [
            'group' => 'seo',
            'name'  => 'OG title',
            'key'   => 'og_title',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'OG type',
            'key'   => 'og_type',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'OG URL',
            'key'   => 'og_url',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'OG description',
            'key'   => 'og_description',
            'type'  => 'textarea'
        ],
        [
            'group' => 'seo',
            'name'  => 'OG image',
            'key'   => 'og_image',
            'type'  => 'text'
        ],

        // Twitter cards
        [
            'group' => 'seo',
            'name'  => 'Twitter Card title',
            'key'   => 'twitter_title',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'Twitter Card site',
            'key'   => 'twitter_site',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'Twitter Card type',
            'key'   => 'twitter_card',
            'type'  => 'text',
        ],
        [
            'group' => 'seo',
            'name'  => 'Twitter Card description',
            'key'   => 'twitter_description',
            'type'  => 'textarea'
        ],
        [
            'group' => 'seo',
            'name'  => 'Twitter Card image',
            'key'   => 'twitter_image',
            'type'  => 'text'
        ],

        // Mail
        [
            'group' => 'mail',
            'name'  => 'Mail server host',
            'key'   => 'mail_host',
            'type'  => 'text'
        ],
        [
            'group' => 'mail',
            'name'  => 'Mail server port',
            'key'   => 'mail_port',
            'type'  => 'text'
        ],
        [
            'group' => 'mail',
            'name'  => 'Mail server username',
            'key'   => 'mail_user',
            'type'  => 'text'
        ],
        [
            'group' => 'mail',
            'name'  => 'Mail server password',
            'key'   => 'mail_password',
            'type'  => 'text'
        ],
        [
            'group' => 'mail',
            'name'  => 'Email address from which to send emails',
            'key'   => 'mail_from_address',
            'type'  => 'text'
        ],
        [
            'group' => 'mail',
            'name'  => 'Name from which to send emails',
            'key'   => 'mail_from_name',
            'type'  => 'text'
        ]
    ]
];
