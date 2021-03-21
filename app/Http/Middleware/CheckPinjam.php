<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\TransaksiDetailModel as TransaksiDetail;

class CheckPinjam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (TransaksiDetail::checkPinjam(Auth::id()) > 0) {
            return redirect('/buku')->with('error','Anda sedang meminjam buku');
        }
        return $next($request);
    }
}
