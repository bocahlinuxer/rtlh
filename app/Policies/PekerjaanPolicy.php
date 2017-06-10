<?php

namespace App\Policies;

use App\User;
use App\Pekerjaan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PekerjaanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pekerjaan.
     *
     * @param  \App\User  $user
     * @param  \App\Pekerjaan  $pekerjaan
     * @return mixed
     */
    public function view(User $user, Pekerjaan $pekerjaan)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create pekerjaans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can update the pekerjaan.
     *
     * @param  \App\User  $user
     * @param  \App\Pekerjaan  $pekerjaan
     * @return mixed
     */
    public function update(User $user, Pekerjaan $pekerjaan)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can delete the pekerjaan.
     *
     * @param  \App\User  $user
     * @param  \App\Pekerjaan  $pekerjaan
     * @return mixed
     */
    public function delete(User $user, Pekerjaan $pekerjaan)
    {
        if($userlogin->tipe == 1)
            return true;
        else
            return false;
    }
}
