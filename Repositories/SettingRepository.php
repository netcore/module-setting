<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Models\Setting;

class SettingRepository
{

    /**
     * @var mixed|null
     */
    protected $cachedSettings = null;

    /**
     * SettingRepository constructor.
     */
    public function __construct()
    {
        $this->cachedSettings = cache()->rememberForever('settings', function () {
            return Setting::all()->keyBy('key');
        });
    }

    /**
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (is_array($key)) {
            return $this->many($key);
        }

        $setting = $this->find($key);

        return array_get($setting, 'value', $default);
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_pluck($this->cachedSettings, 'value', 'key');
    }

    /**
     * @return mixed
     */
    public function grouped()
    {
        return $this->cachedSettings->groupBy('group');
    }

    /**
     * @param      $keys
     * @param null $default
     * @return mixed
     */
    private function many($keys, $default = null)
    {
        $settings = $this->find($keys);
        if (!$settings) {
            return $default;
        }

        return array_pluck($settings, 'value', 'key');
    }

    /**
     * @param $key
     * @return mixed
     */
    private function find($key)
    {
        if (is_array($key)) {
            return $this->cachedSettings->whereIn('key', $key)->all();
        }

        return $this->cachedSettings->get($key);
    }
}
