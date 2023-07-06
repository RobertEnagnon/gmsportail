<?php

namespace App\Policies;

use App\Models\Planning;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlanningPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
        
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Planning $planning): bool
    {
        if ($user->is_admin) {
            return true;
        }else if($user->client_id == $planning->client_id){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->is_admin) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Planning $facture): bool
    {
        if ($user->is_admin) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Planning $planning): bool
    {
        if ($user->is_admin) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Planning $planning): bool
    {
        if ($user->is_admin) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Planning $planning): bool
    {
        if ($user->is_admin) {
            return true;
        }else{
            return false;
        }
    }
}
