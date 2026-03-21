<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    protected function mock_authentication () 
    {
        $mock_user_auth_payload = [
            "username" => "superadmin",
            "password" => "superadmin"
        ];

        return $this->postJson('/api/login/test', $mock_user_auth_payload);
    }

    public function test_should_authenticate(): void
    {
        $response = $this->mock_authentication();

        $response->assertStatus(200);

        $this->assertDatabaseHas('logs', [
            'activity' => 'Sign In',
            'done_by' => 1
        ]);
    }

    public function test_should_refresh_access_token() 
    {
        $loginResponse = $this->mock_authentication();

        $accessToken = $loginResponse->json('access_token');

        $refreshToken = $loginResponse->json('refresh_token');

        $refreshAccessTokenResponse = $this->withHeaders([
            "Authorization" => "Bearer $accessToken"
        ])
        ->postJson('api/refreshtoken', [
            "refresh_token" => $refreshToken
        ]);

        $refreshAccessTokenResponse->assertStatus(200);
    }

    public function test_should_log_out () 
    {
        $loginResponse = $this->mock_authentication();

        $accessToken = $loginResponse->json('access_token');

        $user = $loginResponse->json('user');

        $logoutResponse = $this->withHeaders ([
            "Authorization" => "Bearer $accessToken"
        ])
        ->postJson("/api/logout/test", [
            'user_id' => $user['id']
        ]);

        $logoutResponse->assertStatus(200);
    }
}
