<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Brand;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $allBrandSelectOption = Brand::select('id', 'name')->get();
        View::share('allBrandSelectOption', $allBrandSelectOption);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
