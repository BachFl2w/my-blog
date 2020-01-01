<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;

class CheckIsOwner
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
        $user = $request->user();
        $postIsNotEmpty = collect($request->route('post'))->isNotEmpty();

        return $postIsNotEmpty ? $next($request) : abort(404);
    }
}
