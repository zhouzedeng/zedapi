<?php

namespace App\Providers;

use App\Listeners\PruneOldTokens;
use App\Listeners\RevokedOldTokens;
use App\Listeners\RovokeOldTokens;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        // 'Laravel\Passport\Events\AccessTokenCreated' => [
        //     RevokedOldTokens::class,
        // ],

        // 'Laravel\Passport\Events\RefreshTokenCreated' => [
        //     PruneOldTokens::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
