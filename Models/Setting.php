<?php

namespace Modules\Setting\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\SyncTranslations;
use Modules\Setting\Translations\SettingTranslation;

class Setting extends Model
{
    use Translatable, SyncTranslations;

    /**
     * @var string
     */
    protected $table = 'netcore_setting__settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'group',
        'name',
        'type',
        'meta',
        'has_manager',
        'is_translatable'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * @var string
     */
    public $translationModel = SettingTranslation::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'value'
    ];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * @return array
     */
    public function getAttributesData()
    {
        $attributes = array_get($this->meta, 'attributes', []);

        if (!is_array($attributes)) {
            $attributes = [];
        }

        if (!isset($attributes['class'])) {
            $attributes['class'] = $this->getClass();
        }

        return $attributes;
    }

    /**
     * @return array
     */
    public function getOptionsData()
    {
        $options = array_get($this->meta, 'options', []);
        if (is_array($options)) {
            return $options;
        }

        if (function_exists($options)) {
            $options = $options();
        }

        if (!is_array($options)) {
            return [];
        }

        return $options;
    }

    /**
     * @param $type
     * @return bool
     */
    public function is($type)
    {
        return $this->type === $type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        if ($this->is('file')) {
            return asset($this->value);
        }

        return $this->value;
    }

    /**
     * @return string
     */
    private function getClass()
    {
        $classes = [
            'text'     => 'form-control',
            'textarea' => 'form-control',
            'checkbox' => '',
            'file'     => 'form-control',
            'select'   => 'form-control'
        ];

        return array_get($classes, $this->type, 'form-control');
    }
}
