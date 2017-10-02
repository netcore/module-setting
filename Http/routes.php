<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin/settings', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::get('/', 'SettingController@index');
});
