<?php

namespace Garmauco\CheckerLicApp;

use Illuminate\Support\ServiceProvider;
use Garmauco\CheckerLicApp\Contracts\LicenseValidatorInterface;
use Garmauco\CheckerLicApp\Http\Middleware\CheckLicense;

class CheckerLicenseProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('checkLicense', CheckLicense::class);
    }

    public function register()
    {
        $this->app->singleton(LicenseValidatorInterface::class, function () {
            return new CheckerLicApp();
        });
    }
}
