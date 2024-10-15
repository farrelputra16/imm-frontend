<?php

namespace App\Providers;
use Swift_SmtpTransport;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Mail;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {
        
        Mail::getSwiftMailer()->getTransport()->setStreamOptions([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        Paginator::useBootstrap();
    }
}
