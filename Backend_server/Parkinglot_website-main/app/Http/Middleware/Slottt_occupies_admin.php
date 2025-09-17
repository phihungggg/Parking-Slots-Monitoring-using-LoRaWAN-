<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class Slottt_occupies_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   Log::info('Auth id laf '. Auth::id());
        $user = User::where('id', Auth::id())->first();
        Log::info('user id laf '. $user->id);
        if (!$user || $user->admin_id === null) {
            return redirect('/');
        }
    
        return $next($request);
    }
}
