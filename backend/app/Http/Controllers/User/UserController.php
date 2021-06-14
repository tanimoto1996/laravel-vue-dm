<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(User $user, int $id) {
        $user =  $user->where('id', $id)->first();
        view('users.index', ["user" => $user]);
    }
}
