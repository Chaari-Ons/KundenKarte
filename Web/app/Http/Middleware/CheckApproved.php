<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->approved_at) {
            return new JsonResponse(['message' => __('response.forbidden.approval')], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
