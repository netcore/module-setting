<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Setting\Repositories\SettingRepository;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->setMailConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('setting', function ($app) {
            return new SettingRepository();
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('netcore/module-setting.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'setting');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/setting');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/setting';
        }, config('view.paths')), [$sourcePath]), 'setting');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/setting');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'setting');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'setting');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Set mail config
     */
    private function setMailConfig()
    {
        config(['mail.host' => setting()->get('mail.mail_host', '')]);
        config(['mail.port' => setting()->get('mail.mail_port', '2525')]);
        config(['mail.username' => setting()->get('mail.mail_user', '')]);
        config(['mail.password' => setting()->get('mail.mail_password', '')]);

        config(['mail.from.address' => setting()->get('mail.mail_from_address', '')]);
        config(['mail.from.name' => setting()->get('mail.mail_from_name', '')]);
    }
}
