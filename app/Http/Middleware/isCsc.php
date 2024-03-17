<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class isCsc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session()->all();
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->get()
            ->first()){
            if ($user_details->role_name == 'usc-admin') {
                return redirect()->route('usc-dashboard');
            }else if ($user_details->role_name == 'admin') {
                return redirect()->route('admin-dashboard');
            }elseif($user_details->role_name == 'csc-admin'){

            }
        }else{
            return redirect('/login');
        }
        return $next($request);
    }
}
