<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth; 
use App\Models\Notification; 
use App\Models\User;


class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
{
    view()->composer(['inc.admin.nav', 'inc.employe.nav', 'inc.client.nav'], function ($view) {
        if (Auth::check()) {
            $notifications = Notification::where('user_id', Auth::id())->get();

            $unreadCount = Notification::where('user_id', Auth::id())
                                        ->where('read', false)
                                        ->count();
            $employees = User::where('role', 'employe')->get();

            $view->with('notifications', $notifications)
                 ->with('unreadCount', $unreadCount)
                 ->with('employees', $employees);
        } else {
            $view->with('notifications', collect([])) 
                 ->with('unreadCount', 0)
                 ->with('employees', collect([]));
        }
    });
}




}
