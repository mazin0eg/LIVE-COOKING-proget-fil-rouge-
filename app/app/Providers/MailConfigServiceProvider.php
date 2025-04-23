<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Override mail configuration with Gmail settings
        Config::set('mail.default', 'smtp');
        Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
        Config::set('mail.mailers.smtp.port', 587);
        Config::set('mail.mailers.smtp.encryption', 'tls');
        Config::set('mail.mailers.smtp.username', 'mazin.zougui@gmail.com');
        Config::set('mail.mailers.smtp.password', 'imjs teps sfaa ergo');
        Config::set('mail.from.address', 'mazin.zougui@gmail.com');
        Config::set('mail.from.name', 'Platea');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
