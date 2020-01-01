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
        $post = $request->route('post');

        if (collect($post)->isEmpty()) {
            abort(404);
        }

        if ($user->id !== $post->user_id) {
            abort(403);
        }

        return $next($request);
    }
}
