<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PelayananKesehatanIbu;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelayananKesehatanIbuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('view_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('update_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('delete_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('force_delete_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('restore_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, PelayananKesehatanIbu $pelayananKesehatanIbu): bool
    {
        return $user->can('replicate_pelayanan::kesehatan::ibu');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_pelayanan::kesehatan::ibu');
    }
}
