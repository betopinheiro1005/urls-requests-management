<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckPermissions1
{
    public function handle($request, Closure $next)
    {
        $level = auth()->user()->level;

        // dd($level);

        if ($level == 1) {
            return $next($request);
        }

        Session::flash('erro_permission','Você não tem permissão para realizar essa operação!');

        return redirect()->back();
    }
}
