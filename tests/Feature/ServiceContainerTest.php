<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Person;
use App\Data\Foo;
use App\Data\Bar;

class ServiceContainerTest extends TestCase
{
    public function TestServiceContainer()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);


        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo2());
        self::assertNotEquals($foo1, $foo2);
    }

    public function testBind(){
        $this->app->bind(Person::class, function($app){
            return new Person("Elvin", "Pratama");
        });

        $person1 = $this->app->make(Person::class);//closure()//new Person()
        $person2 = $this->app->make(Person::class);//closure()//new Person()

        self::assertEquals("Elvin", $person1->firstName);
        self::assertEquals("Elvin", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton(){
        $this->app->singleton(Person::class, function($app){
            return new Person("Elvin", "Pratama");
        });

        $person1 = $this->app->make(Person::class);//new Person(); if not exists
        $person2 = $this->app->make(Person::class);//return existing

        self::assertEquals("Elvin", $person1->firstName);
        self::assertEquals("Elvin", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance(){
        $person = new Person("Elvin", "Pratama");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);//$person
        $person2 = $this->app->make(Person::class);//$person

        self::assertEquals("Elvin", $person1->firstName);
        self::assertEquals("Elvin", $person2->firstName);
        self::assertSame($person1, $person2);
    }
}
