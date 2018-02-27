<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Models\Setting;
use Netcore\Translator\Helpers\TransHelper;

class SettingRepository
{
    /**
     * @var mixed
     */
    protected $cachedSettings;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $cacheKey;

    /**
     * SettingRepository constructor.
     */
    public function __construct()
    {
        $this->cacheKey = config('setting.cache_key', 'settings');
        $this->cachedSettings = cache()->rememberForever($this->cacheKey, function () {
            return Setting::all()->keyBy('key');
        });
    }

    /**
     * Get specified setting/s
     *
     * @param array|string $keys
     * @param array|null   $default
     * @return array|string
     */
    public function get($keys, $default = null)
    {
        $settings = $this->cachedSettings;

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
     * Get all settings
     *
     * @return array
     */
    public function all(): array
    {
        return $this->cachedSettings->pluck('value', 'key')->toArray();
    }

    /**
     * Get grouped settings
     *
     * @return array
     */
    public function grouped()
    {
        return $this->cachedSettings->groupBy('group');
    }

    /**
     * Seed settings
     *
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function seed($data)
    {
        if (!is_array($data)) {
            throw new \Exception('Passed settings should be an array');
        }

        foreach ($data as $item) {
            $item['key'] = implode('.', [
                $item['group'],
                $item['key']
            ]);

            $translations = [];
            if (is_array($item['value'])) {
                foreach ($item['value'] as $locale => $value) {
                    $translations[$locale] = [
                        'value' => $value
                    ];
                }
            } else {
                foreach (TransHelper::getAllLanguages() as $language) {
                    $translations[$language->iso_code] = [
                        'value' => $item['value'],
                    ];
                }
            }

            $setting = Setting::firstOrCreate([
                'key' => $item['key']
            ], array_except($item, 'value'));

            $setting->updateTranslations($translations);
        }
    }

    /**
     * Clear cache
     *
     * @return bool
     * @throws \Exception
     */
    public function clear_cache(): bool
    {
        return cache()->forget($this->cacheKey);
    }
}
