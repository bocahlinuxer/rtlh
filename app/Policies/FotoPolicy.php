<?php

namespace App\Policies;

use App\User;
use App\FotoRtlh;
use Illuminate\Auth\Access\HandlesAuthorization;

class FotoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the fotoRtlh.
     *
     * @param  \App\User  $user
     * @param  \App\FotoRtlh  $fotoRtlh
     * @return mixed
     */
    public function view(User $user, FotoRtlh $fotoRtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->id_user === $fotoRtlh->created_by;
        }
    }

    /**
     * Determine whether the user can create fotoRtlhs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the fotoRtlh.
     *
     * @param  \App\User  $user
     * @param  \App\FotoRtlh  $fotoRtlh
     * @return mixed
     */
    public function update(User $user, FotoRtlh $fotoRtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->id_user === $fotoRtlh->created_by;
        }
    }

    /**
     * Determine whether the user can delete the fotoRtlh.
     *
     * @param  \App\User  $user
     * @param  \App\FotoRtlh  $fotoRtlh
     * @return mixed
     */
    public function delete(User $user, FotoRtlh $fotoRtlh)
    {
        if($user->tipe == 1)
        {
            return true;
        }
        else
        {
            return $user->id_user === $fotoRtlh->created_by;
        }
    }
}
