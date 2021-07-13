<?php

namespace App\Providers;

use App\Models\Retailer;
use App\Models\User;
use App\Observers\RetailerObserver;
use App\Observers\UserObserver;
use Dusterio\LumenPassport\LumenPassport;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        User::observe(UserObserver::class);
        Retailer::observe(Retailer::class);
        Passport::ignoreMigrations();
        LumenPassport::routes($this->app);
    }
}