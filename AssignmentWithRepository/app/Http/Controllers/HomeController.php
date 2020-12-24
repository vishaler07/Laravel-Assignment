<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepo;
    protected $postRepo;

    public function __construct(UserRepository $userRepo, PostRepository $postRepo){
        $this->userRepo=$userRepo;
        $this->postRepo=$postRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=$this->userRepo->findByID($user_id);
        $posts=$this->postRepo->all();
        $is_admin=false;
        if($user->isAdmin)
            $is_admin=true;
        $total_posts=$this->postRepo->all();
        $total_users=$this->userRepo->all();
        $users_today=count($total_users);
        $users_month=count($total_users);

        $total_posts=count($total_posts);
        $total_users=count($total_users);

        $current_date=date('Y-m-d');
        $current_month=$current_date[5].$current_date[6];

        if($user->isAdmin)
            return view('adminPages.homepage',compact('total_users','total_posts','users_today','users_month'));

        // if($user->isAdmin)            
        //     return view('adminPages.homepage')->with('posts',$user->posts);

        // else
            return view('posts.postpage',compact('posts','is_admin'));
    }
}
