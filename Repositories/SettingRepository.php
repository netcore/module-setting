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
     * @var \Illuminate\Config\Repository|mixed|null
     */
    protected $cacheKey = null;

    /**
     * @var string|null
     */
    protected $group = null;

    /**
     * SettingRepository constructor.
     */
    public function __construct()
    {
        $this->cacheKey = config('setting.cache_key');
        $this->cachedSettings = cache()->rememberForever($this->cacheKey, function () {
            return Setting::all()->keyBy('key');
        });
    }

    /**
     * @param $method
     * @param $args
     * @return $this
     */
    public function __call($method, $args)
    {
        $this->group = $method;

        return $this;
    }

    /**
     * @param      $keys
     * @param null $default
     * @return mixed
     */
    public function get($keys, $default = null)
    {
        $settings = $this->cachedSettings;

        if ($group = $this->group) {
            $settings = $settings->where('group', $group);
        }

        if (is_array($keys)) {
            $array = [];
            foreach ($keys as $index => $key) {
                $setting = $settings->get($key);
                $array[$key] = $setting ? $setting->getValue() : (is_array($default) ? (isset($default[$index]) ? $default[$index] : null) : $default);
            }

            return $array;
        }

        $setting = $settings->get($keys);
        return $setting ? $setting->getValue() : (is_array($default) ? (isset($default[0]) ? $default[0] : null) : $default);
    }

    /**
     * @return array
     */
    public function all()
    {
        $settings = $this->cachedSettings;
        if ($this->group) {
            $settings = $settings->where('group', $this->group);
        }

        return $settings->pluck('value', 'key')->toArray();
    }

    /**
     * @return mixed
     */
    public function grouped()
    {
        return $this->cachedSettings->groupBy('group');
    }

    /**
     * @return bool
     */
    public function clear_cache()
    {
        return cache()->forget($this->cacheKey);
    }
}
