<?php

namespace App\Providers;

use App\Models\User;
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
        view()->composer('*', function ($view) {
            $user = User::find(auth()->id());
            if (auth()->check() && $user->hasRole('admin')) {
                $view->with('notifications', $user->unreadNotifications);
            }
            if (auth()->check() && ($user->hasRole('donor') || $user->hasRole('patient'))) {
                $view->with('notifications', $user->unreadNotifications);
            }
        });

        // view()->composer('*', function ($view) {
        //     $user = User::find(auth()->id());
        //     if (auth()->check() && $user->hasRole('admin')) {
        //         $notifications = $user->unreadNotifications->map(function ($notification) {
        //             $data = $notification->data;
        //             $donor = User::find($data['donor_id']);

        //             // Add the donor's profile picture to the notification data
        //             if ($donor) {
        //                 $data['profile_picture'] = $donor->profile_picture;
        //             }
        //             $notification->data = $data;
        //             // dd($notification);
        //             return $notification;
        //         });
        //         $view->with('notifications', $notifications);
        //     }
        // });
    }
}
