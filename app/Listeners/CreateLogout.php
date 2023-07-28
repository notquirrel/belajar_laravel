<?php

namespace App\Listeners;

use App\Events\UserLogout;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserLogout  $event
     * @return void
     */
    public function handle(UserLogout $event)
    {
        ActivityLog::create([
            'username' => $event->user->name,
            'activity' => 'logout',
        ]);
    }
}
