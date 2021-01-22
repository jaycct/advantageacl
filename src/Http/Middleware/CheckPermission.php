<?php

namespace jaycct\advantageacl\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(\jaycct\advantageacl\Helpers\PermissionHelper::__checkPermission()){
            return $next($request);
        } else {
            return redirect()->route('admin.dashboard')->with('alert-danger',__('users.permission_denied'));
        }
    }
}
