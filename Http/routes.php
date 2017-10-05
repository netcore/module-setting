<?php

Route::group([
    'middleware' => ['web', 'auth.admin'],
    'prefix'     => 'admin',
    'namespace'  => 'Modules\Setting\Http\Controllers'
], function () {
    Route::resource('settings', 'SettingController', [
        'only'  => [
            'index',
            'edit',
            'update'
        ],
        'names' => [
            'index'  => 'admin::setting.index',
            'edit'   => 'admin::setting.edit',
            'update' => 'admin::setting.update'
        ]
    ]);
});
