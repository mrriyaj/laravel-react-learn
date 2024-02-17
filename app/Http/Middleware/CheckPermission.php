<?php
// CheckPermission.php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roleOrPermission
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $roleOrPermission)
{
    $user = auth()->user();
    $authorized = false; // Set a default value

    switch ($roleOrPermission) {
        case 'admin':
            $authorized = $user->isAdmin();
            break;

        case 'superadmin':
            $authorized = $user->isSuperadmin();
            break;

        case 'shopowner':
            $authorized = $user->isShopowner();
            break;

        case 'user':
            $authorized = $user->isUser();
            break;

        // Remove the default case
        // default:
        //     $authorized = $user->hasPermission($roleOrPermission);
        //     break;
    }

    if ($authorized) {
        return $next($request);
    }

    abort(403, 'Unauthorized action.');
}
}
