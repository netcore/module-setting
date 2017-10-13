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
            ]
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
