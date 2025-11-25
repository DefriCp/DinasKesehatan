<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KasusFluBurung;
use Illuminate\Auth\Access\HandlesAuthorization;

class KasusFluBurungPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_kasus::flu::burung');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('view_kasus::flu::burung');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_kasus::flu::burung');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('update_kasus::flu::burung');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('delete_kasus::flu::burung');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_kasus::flu::burung');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('force_delete_kasus::flu::burung');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_kasus::flu::burung');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('restore_kasus::flu::burung');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_kasus::flu::burung');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, KasusFluBurung $kasusFluBurung): bool
    {
        return $user->can('replicate_kasus::flu::burung');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_kasus::flu::burung');
    }
}
