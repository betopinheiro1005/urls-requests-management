<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckPermissions1
{
    public function handle($request, Closure $next)
    {
        $email = auth()->user()->email;

        // dd($email);

        if (($email == "robertopinheiro7843@gmail.com") || ($email == "administrador@gmail.com")) {
            return $next($request);
        }
        
        Session::flash('erro_permission','Você não tem permissão para realizar essa operação!');

        return redirect()->back();
    }
}
