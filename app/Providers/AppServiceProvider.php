<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\UserAdmin;
use App\Models\UserCandidate;
use App\Models\UserRecruitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('client.layout.*', function ($view) {
            $setting = Setting::first();
            if (Auth::check()) {
                if (Auth::user()->role == 0) {
                    $user = UserCandidate::find(Auth::user()->id);
                } elseif (Auth::user()->role == 50) {
                    $user = UserRecruitment::find(Auth::user()->id);
                } elseif (Auth::user()->role > 100) {
                    $user = UserAdmin::find(Auth::user()->id);
                }
            } else {
                $user = NULL;
            }

            $view->with('setting', $setting);
            $view->with('user', $user);
        });

        View::composer('client.company.layout.*', function ($view) {
            $setting = Setting::first();
            if (Auth::check()) {
                 if (Auth::user()->role == 50) {
                    $user = UserRecruitment::find(Auth::user()->id);
                }
            } else {
                $user = NULL;
            }
            $view->with('user', $user);
            $view->with('setting', $setting);
        });

        View::composer('client.company.layout*', function ($view) {
            $setting = Setting::first();
            $view->with('setting', $setting);
        });

        View::composer('client.search', function ($view) {
            if (Auth::check()) {
                if (Auth::user()->role == 0) {
                    $user_id = UserCandidate::find(Auth::user()->id)->id;
                } else {
                    $user_id = 0;
                }
            } else {
                $user_id = 0;
            }
            $view->with('user_id', $user_id);
        });
    }
}
