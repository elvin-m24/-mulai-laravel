<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\App;

class AppEnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $this->expectNotToPerformAssertions();
        
    }
}
