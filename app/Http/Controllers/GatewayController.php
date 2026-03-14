<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GatewayController extends Controller
{
    //
    public function index (): JsonResponse 
    {
        return response()->json([
            'message' => "This is gateway controller.",
            'success' => true
        ], 200);
    }
}
