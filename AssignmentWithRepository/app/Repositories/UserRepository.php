<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function findByID($userid)
    {
        return User::find($userid);
    }
}