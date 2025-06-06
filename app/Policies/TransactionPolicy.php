<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_transaction');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('view_transaction');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_transaction');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('update_transaction');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('delete_transaction');
    }

    /**
     * Determine whether the user can delete any the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_transaction');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('restore_transaction');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_transaction');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('force_delete_transaction');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_transaction');
    }

    /**
     * Determine whether the user can replicate user.
     */
    public function replicate(User $user): bool
    {
        return $user->hasPermissionTo('replicate_transaction');
    }

    /**
     * Determine whether the user can reorder user.
     */
    public function reorder(User $user): bool
    {
        return $user->hasPermissionTo('reorder_transaction');
    }
}
