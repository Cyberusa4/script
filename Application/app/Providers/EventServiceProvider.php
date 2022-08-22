<?php

namespace App\Providers;

use App\Events\FileEntryDeleted;
use App\Events\UserCreated;
use App\Listeners\CreateDefaultFolders;
use App\Listeners\DeleteParentEntries;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            CreateDefaultFolders::class,
        ],
        FileEntryDeleted::class => [
            DeleteParentEntries::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
