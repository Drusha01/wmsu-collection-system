<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class checkTerm
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
               'sy.date_start',
               'sy.date_end'
              )
            ->leftjoin('school_years as sy','sy.id','u.school_year_id')
            ->where('u.id','=',$session['id'])
            ->whereRaw('(now() between sy.date_start and sy.date_end)')
            ->get()
            ->first()){
            
        }else{
            return redirect('/term-ended');
        }
        return $next($request);
    }
}
