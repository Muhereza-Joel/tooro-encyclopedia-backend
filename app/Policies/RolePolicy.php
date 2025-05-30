<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ModelsRole $role): bool
    {
        return $user->hasPermissionTo('view_role');;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        return $user->hasPermissionTo('create_role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ModelsRole $role): bool
    {
        return $user->hasPermissionTo('update_role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ModelsRole $role): bool
    {
        return $user->hasPermissionTo('delete_role');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_role');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ModelsRole $role): bool
    {
        return $user->hasPermissionTo('restore_role');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ModelsRole $role): bool
    {
        return $user->hasPermissionTo('force_delete_role');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_role');
    }
}
