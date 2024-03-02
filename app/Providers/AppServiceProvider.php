<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us12'
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define('admin', function (User $user) {
           return $user->username === 'dwood';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }

    
}
