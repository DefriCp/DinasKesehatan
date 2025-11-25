<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PelayananKesehatanHipertensi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelayananKesehatanHipertensiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('view_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('update_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('delete_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('force_delete_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('restore_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, PelayananKesehatanHipertensi $pelayananKesehatanHipertensi): bool
    {
        return $user->can('replicate_pelayanan::kesehatan::hipertensi');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_pelayanan::kesehatan::hipertensi');
    }
}
