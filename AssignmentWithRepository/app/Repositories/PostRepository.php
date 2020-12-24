<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostRepository
{
    public function all()
    {
        return Post::orderBy('created_at','desc')->get();
    }

    public function findByID($userid)
    {
        return Post::find($userid);
    }
}