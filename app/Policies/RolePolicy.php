<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * super_admin boleh semua.
     * Kalau user punya role super_admin, langsung true untuk semua ability.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole(config('filament-shield.super_admin.name'))) {
            return true;
        }

        return null; // lanjut ke method lain
    }

    public function viewAny(User $user): bool
    {
        // Non-super_admin TIDAK boleh lihat daftar role
        return false;
    }

    public function view(User $user, Role $role): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Role $role): bool
    {
        return false;
    }

    public function delete(User $user, Role $role): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
