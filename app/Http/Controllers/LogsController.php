<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponsee
    {
        try {
            return response()->json ([
                "message" => "Logs created successfully",
                "success" => true,
            ],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json ([
                "message" => "Something went wrong",
                "reason" => $e->getMessage(),
                "success" => false,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): JsonResponse
    {
        //
        try {
            \DB::beginTransaction();
            //Logs::create($request->all());
            \DB::commit();
            return response()->json ([
                "message" => "Logs created successfully",
                "success" => true,
            ],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json ([
                "message" => "Something went wrong",
                "reason" => $e->getMessage(),
                "success" => false,
            ], 500);
        }
    }


    public function show(Logs $logs): JsonResponse
    {
        try {
            return response()->json ([
                "message" => "Logs created successfully",
                "success" => true,
            ],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json ([
                "message" => "Something went wrong",
                "reason" => $e->getMessage(),
                "success" => false,
            ], 500);
        }
    }

    public function update(Request $request, Logs $logs): JSonResponse
    {
        //
        try {
            \DB::transaction();
            return response() -> json ([
                "message" => "Logs created successfully",
                "success" => true,
            ],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response() -> json ([
                "message" => "Something went wrong",
                "reason" => $e->getMessage(),
                "success" => false,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logs $logs): JsonResponse
    {
        //
        try {
            return response()->json ([
                "message" => "Logs created successfully",
                "success" => true,
            ],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json ([
                "message" => "Something went wrong",
                "reason" => $e->getMessage(),
                "success" => false,
            ], 500);
        }
    }
}
