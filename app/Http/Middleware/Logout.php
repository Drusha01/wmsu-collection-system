<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Logout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $session = $request->session()->all();
        if(isset($session['id'])){
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$session['id'],
                'log_details' =>'has logged out',
                'link' => '#',
            ]);
        }
        $request->session()->invalidate();

        return redirect('/login');
    }
}
