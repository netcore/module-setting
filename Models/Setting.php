<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /**
     * @var string
     */
    protected $table = 'netcore_setting__settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'name',
        'meta'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'meta' => 'array'
    ];

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
