<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        if (App::environment(['staging', 'production'])) {
            URL::forceScheme('https');
        }
        /*if ($this->app->environment('production')) {
            !isset($_SERVER['HTTPS']) ?? http_redirect(env('APP_URL') . $_SERVER['REQUEST_URI']);
            URL::forceScheme('https');
        }*/
    }

}
