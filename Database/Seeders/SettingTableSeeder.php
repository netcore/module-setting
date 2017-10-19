<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = [
            [
                'group' => 'custom-scripts',
                'name'  => 'Google Analytics API key',
                'key'   => 'google-analytics-api-key',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'custom-scripts',
                'name'  => 'Google Analytics client ID',
                'key'   => 'google-analytics-client-id',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'custom-scripts',
                'name'  => 'Google Analytics script',
                'key'   => 'google-analytics-script',
                'value' => '',
                'type'  => 'textarea',
            ],
            [
                'group' => 'custom-scripts',
                'name'  => 'Custom scripts',
                'key'   => 'custom-js',
                'value' => '',
                'type'  => 'textarea',
            ],
            [
                'group' => 'custom-scripts',
                'name'  => 'Custom styles',
                'key'   => 'custom-css',
                'value' => '',
                'type'  => 'textarea'
            ],

            [
                'group' => 'seo',
                'name'  => 'Meta keywords',
                'key'   => 'meta-keywords',
                'value' => '',
                'type'  => 'textarea',
            ],
            [
                'group' => 'seo',
                'name'  => 'Meta description',
                'key'   => 'meta-description',
                'value' => '',
                'type'  => 'textarea',
            ],

            // Facebook OG tags
            [
                'group' => 'seo',
                'name'  => 'OG title',
                'key'   => 'og:title',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'OG type',
                'key'   => 'og:type',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'OG URL',
                'key'   => 'og:url',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'OG description',
                'key'   => 'og:description',
                'value' => '',
                'type'  => 'textarea'
            ],
            [
                'group' => 'seo',
                'name'  => 'OG image',
                'key'   => 'og:image',
                'value' => '',
                'type'  => 'text'
            ],

            // Twitter cards
            [
                'group' => 'seo',
                'name'  => 'Twitter Card title',
                'key'   => 'twitter:title',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'Twitter Card site',
                'key'   => 'twitter:site',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'Twitter Card type',
                'key'   => 'twitter:card',
                'value' => '',
                'type'  => 'text',
            ],
            [
                'group' => 'seo',
                'name'  => 'Twitter Card description',
                'key'   => 'twitter:description',
                'value' => '',
                'type'  => 'textarea'
            ],
            [
                'group' => 'seo',
                'name'  => 'Twitter Card image',
                'key'   => 'twitter:image',
                'value' => '',
                'type'  => 'text'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
