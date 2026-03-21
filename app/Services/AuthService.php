<?php
namespace App\Services;

use Illuminate\Http\Request;

class AuthService extends BaseService {

    protected const AUTH_SERVICE_BASE_URL = "http://nginx/api/auth";

    public function __construct() {
        parent::__construct();
    }

    public function login(Request $request): array
    {
        return $this->asyncRequest([
            [
                'method' => 'POST',
                'url' => self::AUTH_SERVICE_BASE_URL . "/login",
                'headers' => [],
                'options' => [
                    "username" => $request->input('username'),
                    "password" => $request->input('password'),
                ]
            ]
        ]);
    }

    public function logout(Request $request): array
    {
        return $this->asyncRequest([
            [
                'method' => 'POST',
                'url' => self::AUTH_SERVICE_BASE_URL. "/logout",
                'headers' => [
                    'Authorization' => "Bearer {$request->bearerToken()}"
                ],
                'options' => [
                    'user_id' => $request->input('user_id')
                ]
            ]
        ]);
    }

    public function me(Request $request): array
    {
        return $this->asyncRequest([
            [
                'method' => 'POST',
                'url' => self::AUTH_SERVICE_BASE_URL. "/me",
                'headers' => [
                    'Authorization' => "Bearer {$request->bearerToken()}"
                ],
                'options' => []
            ]
        ]);
    }

    public function refreshtoken(Request $request): array
    {
        return $this->asyncRequest([
            [
                'method' => 'POST',
                'url' => self::AUTH_SERVICE_BASE_URL. "/refreshAccessToken",
                'headers' => [
                    'Authorization' => "Bearer {$request->bearerToken()}"
                ],
                'options' => [
                    'refresh_token' => $request->input('refresh_token')
                ]
            ]
        ]);
    }
}