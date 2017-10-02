<?php

if (! function_exists('setting')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed, we'll assume you want to update setting values.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed
     *
     * @throws \Exception
     */
    function setting()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app('setting');
        }

        if (is_string($arguments[0])) {
            return app('setting')->get($arguments[0], isset($arguments[1]) ? $arguments[1] : null);
        }

        if (! is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the cache, you must pass an array of key / value pairs.'
            );
        }

        if (! isset($arguments[1])) {
            throw new Exception(
                'You must specify an expiration time when setting a value in the cache.'
            );
        }

        return app('setting')->put(key($arguments[0]), reset($arguments[0]), $arguments[1]);
    }
}