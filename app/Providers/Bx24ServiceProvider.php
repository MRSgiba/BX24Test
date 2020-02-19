<?php

namespace App\Providers;

use App\Models\Bx24Portal;
use App\Services\Bx24App\Bx24AppService;
use App\Services\Bx24App\CheckInstallStategies\CheckRowInPortalModelStrategy;
use App\Services\Bx24App\InstallStrategies\SaveToPortalModelStrategy;
use Bitrix24\Bitrix24;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class Bx24ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bx24_app_version', function () {
            if (!Route::is('bx24.v*')) {
                return null;
            }

            $currentRouteName = Route::currentRouteName();
            $versionRegex = '/^bx24\.v(\d+)\./';

            preg_match($versionRegex, $currentRouteName, $matches);

            $version = $matches[1];

            return $version;
        });

        $this->app->singleton('bx24_install_route', function ($app) {
            return "bx24.v{$app->bx24_app_version}.install";
        });

        $this->app->singleton(Bitrix24::class, function ($app) {
            $bx24 = new Bitrix24();

            $appVersion = $app->bx24_app_version;

            if (!$appVersion) {
                throw new \Exception('Version of Bitrix24 app was not defined');
            }

            $appScope = config("bx24.v{$appVersion}.scope");
            $appId = config("bx24.v{$appVersion}.id");
            $appSecret = config("bx24.v{$appVersion}.secret");

            $bx24->setApplicationScope($appScope);
            $bx24->setApplicationId($appId);
            $bx24->setApplicationSecret($appSecret);

            $bx24->setDomain(request()->DOMAIN);
            $bx24->setMemberId(request()->member_id);
            $bx24->setAccessToken(request()->AUTH_ID);
            $bx24->setRefreshToken(request()->REFRESH_ID);

            // TODO: настроить использование setOnExpiredToken

            return $bx24;
        });

        $this->app->singleton(Bx24Portal::class, function ($app) {
            $portal = Bx24Portal::firstOrNew(['domain' => request()->DOMAIN]);
            $portal->version = $app->bx24_app_version;

            return $portal;
        });

        $this->app->singleton(Bx24AppService::class, function ($app) {
            $bx24AppService = new Bx24AppService();

            $portal = $app->make(Bx24Portal::class);

            $installStrategy = new SaveToPortalModelStrategy();
            $installStrategy->setPortalModel($portal);
            $bx24AppService->setInstallStrategy($installStrategy);

            $checkInstallStrategy = new CheckRowInPortalModelStrategy();
            $checkInstallStrategy->setPortalModel($portal);
            $bx24AppService->setCheckInstallStrategy($checkInstallStrategy);

            return $bx24AppService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
