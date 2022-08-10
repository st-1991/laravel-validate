<?php

namespace LaravelValidate;

use Illuminate\Support\ServiceProvider;
use LaravelValidate\commands\MakeValidateCommand;

class ValidateProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/validate.php' => config_path('validate.php'), // 发布配置文件到 laravel 的config 下
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeValidateCommand::class
            ]);
        }
    }

    public function register()
    {
        $this->app->singleton('validate', function () {
            return new ValidateService();
        });
    }
}
