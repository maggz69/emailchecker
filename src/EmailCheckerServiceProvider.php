<?php

namespace EmailChecker;

use Illuminate\Support\ServiceProvider;

class EmailCheckerServiceProvider extends ServiceProvider{

    public function boot(){
        $this->publishes([
            __DIR__.'/../config/emailchecker.php' => config_path('emailchecker.php'),
        ],'config');
    }

    public function register(){

    }
}