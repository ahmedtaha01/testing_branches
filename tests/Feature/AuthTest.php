<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_unauthorized_users_can_not_access_products_page()
    {
        $response = $this->get('/products');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }
}
