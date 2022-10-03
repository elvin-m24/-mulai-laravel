<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Elvin')
            ->assertSeeText('Hello Elvin');

        $this->post('/input/hello', [
            'name' => 'Elvin'
        ])->assertSeeText('Hello Elvin');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Elvin",
                "last" => "Pratama"
            ]
        ])->assertSeeText("Hello Elvin");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Elvin",
                "last" => "Pratama"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Elvin")
            ->assertSeeText("Pratama");
    }

}
