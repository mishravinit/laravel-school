<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiStudentsId()
    {
        $response = $this->get('/api/students/1');
        $response->assertStatus(200);
    }

    
}
