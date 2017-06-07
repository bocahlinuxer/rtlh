<?php

namespace App\Policies;

use App\User;
use App\Rtlh;
use Illuminate\Auth\Access\HandlesAuthorization;

class RtlhPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the rtlh.
     *
     * @param  \App\User  $user
     * @param  \App\Rtlh  $rtlh
     * @return mixed
     */
    public function view(User $user, Rtlh $rtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->user_id === $rtlh->created_by;
        }
    }

    /**
     * Determine whether the user can create rtlhs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the rtlh.
     *
     * @param  \App\User  $user
     * @param  \App\Rtlh  $rtlh
     * @return mixed
     */
    public function update(User $user, Rtlh $rtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->user_id === $rtlh->created_by;
        }
    }

    /**
     * Determine whether the user can delete the rtlh.
     *
     * @param  \App\User  $user
     * @param  \App\Rtlh  $rtlh
     * @return mixed
     */
    public function delete(User $user, Rtlh $rtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->user_id === $rtlh->created_by;
        }
    }
}
