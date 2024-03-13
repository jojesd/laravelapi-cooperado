<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TokenValidationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $tokenData = DB::table('tokens')->first();

        if (!$tokenData || $tokenData->token !== $token || $this->tokenExpirado($tokenData->expiration)) {
            return response()->json(['error' => 'Token errado ou expirado'], 401);
        }

        return $next($request);
    }

    private function tokenExpirado($expiration)
    {
        return Carbon::now()->diffInMinutes(Carbon::parse($expiration)) > 30;
    }
}
