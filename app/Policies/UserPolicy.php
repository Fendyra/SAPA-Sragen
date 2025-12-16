<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Siapa yang boleh melihat daftar user di menu? (viewAny)
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh melihat detail satu user? (view)
     */
    public function view(User $user, User $model): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh bikin user baru? (create)
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh edit user? (update)
     */
    public function update(User $user, User $model): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh hapus user? (delete)
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role === 'admin';
    }
}