<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Image;
use App\Models\User;

class PolicyForImage
{

    public function update(User $user,Image $image) {
        return $image->user_id == $user->id || $user->role == Role::Editor;
    }

    public function delete(User $user,Image $image) {
        return $image->user_id == $user->id || $user->role == Role::Editor;
    }
}
