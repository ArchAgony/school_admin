<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where("remember_token", $request->token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'unauthorized'
            ]);
        }

        $request->attributes->set('remember_token', $user->id);
        return $next($request);
    }
}
