<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Http\Repositories\LogRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LogsController extends Controller
{
    public function __construct(
        protected readonly LogRepository $logRepository
    ){}

    public function index (Request $request): JsonResponse
    {
        try {
            $response = $this->logRepository
                ->get($request)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }

    public function find(int $id): JsonResponse
    {
        try {
            $response = $this->logRepository->find($id);

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "failed",
                "reason" => $e->getMessage(),
                "success" => false
            ], 500);
        }
    }
}
