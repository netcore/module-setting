<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = config('netcore.module-setting.default_settings');

        foreach ($settings as $data) {
            $setting = Setting::firstOrCreate([
                'key' => $data['key']
            ], $data);

            $translations = [];
            foreach (\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language) {
                $translations[$language->iso_code] = [
                    'value' => ''
                ];
            }
            $setting->updateTranslations($translations);
        }
    }
}
