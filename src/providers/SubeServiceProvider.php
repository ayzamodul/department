<?php

namespace ayzamodul\department\Providers;

use Illuminate\Support\ServiceProvider;

class SubeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'sube');


    }
    public function  register()
    {

    }
}
