<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userDesignation = strtolower($request->input('user_designation')) ?? null;

        if (! $userDesignation || $userDesignation !== 'super admin') {
            return response()->json([
                'message' => "Cannot perform this operation, must be a super admin role!",
                'reason' => 'Access not allowed',
                'success' => false,
            ], 422);
        }

        return $next($request);
    }
}
