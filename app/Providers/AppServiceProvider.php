<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configure mail transport to bypass SSL verification for local development
        if (config('mail.default') === 'smtp') {
            $this->app->afterResolving(\Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport::class, function ($transport) {
                $stream = $transport->getStream();
                
                if (method_exists($stream, 'setStreamOptions')) {
                    $stream->setStreamOptions([
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ],
                    ]);
                }
            });
        }
    }
}
