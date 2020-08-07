<?php

namespace EmailChecker;

use EmailChecker\Commands\CheckEmailCommand;
use Illuminate\Support\ServiceProvider;

class EmailCheckerServiceProvider extends ServiceProvider{

    public function boot(){
        /*
         * Publish the config file for use by Laravel
         * */
        $this->publishes([
            __DIR__.'/../config/emailchecker.php' => config_path('emailchecker.php'),
        ],'config');

        /*
         * Register an artisan command for checking the emails from the command line
         * */
        $this->commands([
            CheckEmailCommand::class
        ]);
    }

    public function register(){

    }
}
