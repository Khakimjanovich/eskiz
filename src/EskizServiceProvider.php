<?php

namespace NotificationChannels\Eskiz;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class EskizServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(EskizChannel::class)
            ->needs(Eskiz::class)
            ->give(function () {
                $apiKey = config('services.eskiz.api_key');

                return new Eskiz(
                    $apiKey,
                    new HttpClient()
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //register
    }
}
