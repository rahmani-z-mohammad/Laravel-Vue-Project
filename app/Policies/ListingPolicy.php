<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use PhpParser\Node\Stmt\Return_;

class ListingPolicy
{
    // if we want to override every generallt action, then we check our users permission like Admin or User
    // this function run before all below methods
    public function before(?User $user, $ability){
        if($user->is_admin /*&& $ability === 'update'*/){
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     * 
     * ? before the class mean optional and allow everyone to access the content
     * 
     * viewAny call before the index function in ListingController
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing)
    {
        return $user->id == $listing->by_user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing)
    {
        return $user->id == $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing)
    {
        return $user->id == $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing)
    {
        return $user->id == $listing->by_user_id;
    }
}
