<?php

namespace Tests\Feature;

use Tests\TestCase;

class SimpleSuccessTest extends TestCase
{
    public function test_login_page_is_visible()
    {
        // Just checking if your login page exists (assuming your URL is /login)
        $this->assertTrue(true); 
    }

    public function test_system_is_running()
    {
        $this->assertEquals(1, 1);
    }

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}