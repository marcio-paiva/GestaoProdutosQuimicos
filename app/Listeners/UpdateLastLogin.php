<?php

namespace App\Listeners;

use Carbon\Carbon;

class UpdateLastLogin
{
    public function handle(\Illuminate\Auth\Events\Login $event): void
    {
        /** @var \App\Models\User $user */
        $user = $event->user;

        $user->update([
            'last_login_at' => \Carbon\Carbon::now()
        ]);
    }
}