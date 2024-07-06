<?php

namespace App\Policies;

use App\Enums\Role;
use Illuminate\Auth\Access\Response;
use App\Models\Image;
use App\Models\User;

class ImagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user) //: bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Image $image) //: bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user) //: bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Image $image) //: bool
    {
        return $image->user_id == $user->id || $user->role == Role::Editor;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Image $image) //: bool
    {
        return $image->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Image $image) //: bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Image $image) //: bool
    {
        //
    }
}
