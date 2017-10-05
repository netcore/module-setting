<?php

if (!function_exists('setting')) {

    /**
     * @return \Illuminate\Foundation\Application
     */
    function setting()
    {
        return app('setting');
    }
}
