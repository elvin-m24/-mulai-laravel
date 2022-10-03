<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Elvin');

        $this->get('/hello-again')
            ->assertSeeText('Hello Elvin');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Elvin');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Elvin'])
            ->assertSeeText('Hello Elvin');

        $this->view('hello.world', ['name' => 'Elvin'])
            ->assertSeeText('World Elvin');
    }
}
