<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateLogin
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
     * @param  \App\Events\UserLogin  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        ActivityLog::create([
            'username' => $event->user->name,
            'activity' => 'login',
        ]);
    }
}
