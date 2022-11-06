<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laudis\Neo4j\Basic\Driver;
use Laudis\Neo4j\Basic\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register():void
    {
        $this->app->singleton(Session::class,static function(){
            return Driver::create('bolt://neo4j:password@localhost:7687')->createSession();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot():void
    {
        //
    }
}
