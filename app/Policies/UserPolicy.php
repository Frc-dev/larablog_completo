<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function before(User $auth, $ability){
        if($auth->isAdmin()){
            return true;
        }
        else{
            return false;
        }
    }
    public function __construct()
    {
        //
    }

    public function edit(User $user, User $auth){
        return $auth->id == $user->id;
    }
}
