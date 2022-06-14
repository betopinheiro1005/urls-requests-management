<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckPermissions2
{
    public function handle($request, Closure $next)
    {

        $level = auth()->user()->level;

        if ($level == 1 || $level == 2) {
            return $next($request);
        }
        
        Session::flash('erro_permission','Você não tem permissão para realizar essa operação!');
        return redirect()->back();

    }
}
