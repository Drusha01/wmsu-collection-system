<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountisValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        $session = $request->session()->all();
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'is_active'
              )
            ->where('u.id','=',$session['id'])
            ->get()
            ->first()){
            if($user_details->is_active == 0){
                return redirect()->route('disabled-account');
            }
        }
        return $next($request);
    }
}
