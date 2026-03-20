<?php
namespace App\Services;

use Illuminate\Http\Request;

class IpManagerService extends BaseService {

    protected const IP_MANAGER_BASE_URL = "http://nginx/api/ipmanager";
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function get(Request $request, int|null $page = null) 
    {
        return $this->asyncRequest([
            [
                'method' => 'GET',
                'url' => self::IP_MANAGER_BASE_URL. ($page ? "?page={$page}" : ''),
                'headers' => [
                    "Authorization" => "Bearer {$request->bearerToken()}"
                ],
                'options' => $request->all()
            ]
        ]);
    }

    public function create(Request $request) 
    {
        return $this->asyncRequest([
            [
                'method' => 'POST',
                'url' => self::IP_MANAGER_BASE_URL. "/create",
                'headers' => [
                    "Authorization" => "Bearer {$request->bearerToken()}" 
                ],
                'options' => $request->all()
            ]
        ]);
    }

    public function find(Request $request, int $id)
    {
        return $this->asyncRequest([
            [
                'method' => 'GET',
                'url' => self::IP_MANAGER_BASE_URL. "/find/{$id}",
                'headers' => [
                    "Authorization" => "Bearer {$request->bearerToken()}" 
                ],
                'options' => []
            ]
        ]);
    }

    public function update(int $id, Request $request) 
    {
        return $this->asyncRequest([
            [
                'method' => 'PUT',
                'url' => self::IP_MANAGER_BASE_URL."/update/{$id}",
                'headers' => [
                    "Authorization" => "Bearer {$request->bearerToken()}" 
                ],
                'options' => $request->all()
            ]
        ]);
    }

    public function kill(int $id, Request $request) 
    {
        return $this->asyncRequest([
            [
                'method' => 'DELETE',
                'url' => self::IP_MANAGER_BASE_URL."/kill/{$id}",
                'headers' => [
                    "Authorization" => "Bearer {$request->bearerToken()}" 
                ],
                'options' => [
                    'user_designation' => $request->input('user_designation')
                ]
            ]
        ]);
    }

}