<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Menu;
use Netcore\Translator\Helpers\TransHelper;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        menu()->seedItems([
            'leftAdminMenu' => [
                [
                    'name' => TransHelper::getAllLanguages()->mapWithKeys(function ($language) {
                        return [$language->iso_code => 'Settings'];
                    }),
                    'value' => TransHelper::getAllLanguages()->mapWithKeys(function ($language) {
                        return [$language->iso_code => 'admin::setting.index'];
                    }),
                    'icon'            => 'ion-gear-b',
                    'type'            => 'route',
                    'is_active'       => 1,
                    'active_resolver' => 'admin::setting.*',
                    'module'          => 'Setting',
                    'parameters'      => json_encode([])
                ]
            ],
        ]);
    }
}
