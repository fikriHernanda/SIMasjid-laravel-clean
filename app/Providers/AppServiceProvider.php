<?php

namespace App\Providers;

use App\Models\Aset\Laporan;
use App\Observers\laporanObserver;
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
        //
        
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');
    }
}
