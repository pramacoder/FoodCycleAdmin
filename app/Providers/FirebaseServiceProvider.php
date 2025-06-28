<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory; // Ensure you have installed the kreait/firebase-php package
class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('firebase', fn () =>
        (new Factory)->withServiceAccount(config('storage/app/foodwaste-60618-firebase-adminsdk-fbsvc-95457603dd.json'))->createAuth()
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
