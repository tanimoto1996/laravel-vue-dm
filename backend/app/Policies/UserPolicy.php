<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected $users = [
        'App\Models\User' => 'App\Policies\User',
    ];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user, Request $request) {
        dd($request);
        return $user->id !== $request->route()->parameter('id');
    }
}
