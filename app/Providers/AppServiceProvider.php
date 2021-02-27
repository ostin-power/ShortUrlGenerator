<?php

namespace App\Providers;

use App\Helpers\ShorterGeneratorHelper;

use App\Interfaces\ShortUrlInterface;
use App\Repositories\ShortUrlRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Registering Repository
        $this->app->bind(ShortUrlInterface::class, ShortUrlRepository::class);

        //Registering Helpers
        $this->app->singleton('ShorterGeneratorHelper', ShorterGeneratorHelper::class);
    }
}
