<?php

namespace App\Providers;

use App\Services\OpenaiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OpenaiService::class, function () {
            $openaiClient = \Tectalic\OpenAi\Manager::build(
                new \GuzzleHttp\Client(),
                new \Tectalic\OpenAi\Authentication(config('openai.auth_key'))
            );
            return new OpenaiService($openaiClient);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
