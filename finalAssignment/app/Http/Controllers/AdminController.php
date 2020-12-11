<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;





class AdminController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user=auth()->user();
        $user_id=auth()->user()->id;

        if($user->isAdmin and $user_id==1)
        {
            $total_users=User::all();
            $total_posts=Post::all();
            $users_today=count($total_users);
            $users_month=count($total_users);

            $total_posts=count($total_posts);
            $total_users=count($total_users);

            $current_date=date('Y-m-d');
            $current_month=$current_date[5].$current_date[6];

            
            return view('adminPages.homepage',compact('total_users','total_posts','users_today','users_month'));
        }
        
        else
            abort(404,"Access Denied for this page!");


    }   
}
