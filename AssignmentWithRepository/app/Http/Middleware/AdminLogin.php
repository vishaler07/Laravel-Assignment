<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository=$postRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $posts=$this->postRepository->all();


        $user=auth()->user();
        $is_admin=false;
        if($user->isAdmin){
            $is_admin=true;
            return $next($request);
        }
       return redirect(route('postsview'));
    }
}
