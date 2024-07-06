<?php

namespace App\Providers;

use App\Enums\Role;
// use App\Models\Image;
// use App\Models\User;
// use App\Policies\PolicyForImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Image::class => PolicyForImage::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Gate::define("update-image", function (User $user ,Image $imag) {
        //     return $imag->user_id == $user->id || $user->role == Role::Editor;
        // });

        // Gate::define("update-image", [PolicyForImage::class,'update']);
        // Gate::define("delete-image", [PolicyForImage::class,'delete']);

        // Gate::define("delete-image", function (User $user ,Image $imag) {
        //     return $imag->user_id == $user->id ;
        // });
        // Gate::before(function($user,$ability){
        //     if($user->role === Role::Admin){
        //         return true;
        //     }
        // });
    }
}
