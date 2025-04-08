<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
      // Update user status when logging in
Event::listen(Login::class, function ($event) {
    // Ensure user exists and is not null
    if ($event->user) {
        $event->user->update(['status' => 'active']);
    }
});

// Update user status when logging out
Event::listen(Logout::class, function ($event) {
    // Ensure user exists and is not null
    if ($event->user) {
        // Only update the status for users, not admin
        if ($event->user->role !== 'admin') {  // Make sure you have role check for admin
            $event->user->update(['status' => 'inactive']);
        }
    }
});

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
