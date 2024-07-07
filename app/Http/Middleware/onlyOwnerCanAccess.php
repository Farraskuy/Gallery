<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class onlyOwnerCanAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $album = $request->route('album');
        if ($album->user_id != Auth::id()) {
            abort(403, 'Anda tidak dapat mengakses data ini');
        }

        return $next($request);
    }
}
