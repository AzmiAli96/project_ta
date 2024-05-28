<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\Models\Activity;

class ActivityListener implements ShouldQueue
{
    public function onLogin(Login $event){
        Activity::log('User ' . $event->user->email . 'logged in');
    }

    public function onLogout(Logout $event){
        Activity::log('User ' . $event->user->email . 'logged in');
    }
}