<?php

namespace Modules\Setting\Translations;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{

    /**
     * @var string
     */
    protected $table = 'netcore_setting__setting_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'value',
        'locale' // This is very important
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

}
