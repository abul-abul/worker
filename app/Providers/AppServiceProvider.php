<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\CityInterface',
            'App\Services\CityService'
        );
        $this->app->bind(
            'App\Contracts\CountryInterface',
            'App\Services\CountryService'
        );
        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Services\UserService'
        );
        $this->app->bind(
            'App\Contracts\MailInterface',
            'App\Services\MailService'
        );
        $this->app->bind(
            'App\Contracts\TaskInterface',
            'App\Services\TaskService'
        );
        $this->app->bind(
            'App\Contracts\CategoryInterface',
            'App\Services\CategoryService'
        );
        $this->app->bind(
            'App\Contracts\QuestionInterface',
            'App\Services\QuestionService'
        );
        $this->app->bind(
            'App\Contracts\AnswerInterface',
            'App\Services\AnswerService'
        );
        $this->app->bind(
            'App\Contracts\TaskProviderInterface',
            'App\Services\TaskProviderService'
        );
    }
}
