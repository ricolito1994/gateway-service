<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;
use App\Services\IpManagerService;
use App\Http\Repositories\LogRepository;

class GatewayController extends Controller
{
    // inject services to controller
    // you can add more here
    public function __construct(
        protected readonly AuthService $authService,
        protected readonly IpManagerService $ipService,
        protected readonly LogRepository $logRepository
    ) {
    }

    public function index (): JsonResponse 
    {
        return response()->json([
            'message' => "This is gateway controller.",
            'success' => true
        ], 200);
    }

    public function login(Request $request, string|null $test = null): JsonResponse 
    {
        try {
            $response = $this->authService->login($request);

            if(isset($response['data']['user'])) {
                $this->logRepository->create([
                    'activity' => 'Sign In ' . ($test ? "test" : ""),
                    'done_by' => $response['data']['user']['id'],
                ]);
            }

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function logout(Request $request, string | null $test = null): JsonResponse 
    {
        try {
            $response = $this->authService->logout($request);

            $this->logRepository->create([
                'activity' => 'Sign Out '. ($test ? "test" : ""),
                'done_by' => $request->input('user_id'),
            ]);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function me(Request $request): JsonResponse 
    {
        try {
            $response = $this->authService->me($request);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function findUser(Request $request, int $id): JsonResponse 
    {
        try {
            $response = $this->authService->findUser($request, $id);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function refreshtoken(Request $request): JsonResponse 
    {
        try {
            $response = $this->authService->refreshtoken($request);

            //$this->logRepository->create([
            //    'activity' => 'Request to change refresh token.',
            //    'done_by' => $request->input('userId'),
            //]);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function indexIP(Request $request, int|null $page = null): JsonResponse
    {
        try {
            $response = $this->ipService->get($request, $page);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function findIP(Request $request, int $id): JsonResponse
    {
        try {
            $response = $this->ipService->find($request, $id);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function updateIP(Request $request, int $id, int $userId): JsonResponse
    {
        try {
            $response = $this->ipService->update($id, $request);

            $this->logRepository->create([
                'activity' => 'Update IP address.',
                'done_by' => $userId,
            ]);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function createIP(Request $request, int $userId): JsonResponse
    {
        try {
            $response = $this->ipService->create($request);

            $this->logRepository->create([
                'activity' => 'Created IP address.',
                'done_by' => $userId,
            ]);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function deleteIP(Request $request, int $id, int $userId): JsonResponse
    {
        try {
            $response = $this->ipService->kill($id, $request);

            $this->logRepository->create([
                'activity' => 'Deleted IP address.',
                'done_by' => $userId,
            ]);

            return response()->json($response['data'], $response['status']);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }
}
