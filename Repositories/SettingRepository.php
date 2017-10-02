<?php
namespace Modules\Setting\Repositories;

class SettingRepository {

    private static $cachedSettings = [];

    public function get($key)
    {
        if (is_array($key)) {
            return $this->many($key);
        }

        if( !self::$cachedSettings ){
            self::$cachedSettings = cache()->rememberForever('settings', function(){
                return \Modules\Setting\Models\Setting::all()->keyBy('key')->toArray();
            });
        }

        if( $setting = array_get(self::$cachedSettings, $key) ){
            return $setting['value'];
        }

        return null;
    }

    public function put()
    {

    }

    public function many()
    {

    }
}