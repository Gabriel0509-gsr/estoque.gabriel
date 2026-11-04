<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    public function test_login_page_renders_for_get_request(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertViewIs('login_site');
    }

    public function test_api_login_returns_validation_errors_for_missing_credentials(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'senha']);
    }
}
