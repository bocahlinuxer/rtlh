<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $userlogin, User $user)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $userlogin
     * @return mixed
     */
    public function create(User $userlogin)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $userlogin
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $userlogin, User $user)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $userlogin
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $userlogin, User $user)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }
}
