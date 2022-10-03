<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
                 
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class FooBarServiceProvider extends ServiceProvider
{

    public array $singleton = [
        HelloService::class => HelloServiceIndonesia::class
    ]; 

    public function register()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });
            
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }
        


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    public function provides(){
        return [HelloService::class, Foo::class, Bar::class];
    }
}