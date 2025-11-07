<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\EmailServiceInterface;
use App\Services\EmailService;
use App\Services\SendRegistrationMail;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailServiceInterface::class, EmailService::class);
        $this->app->bind(EmailServiceInterface::class, SendRegistrationMail::class);
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
