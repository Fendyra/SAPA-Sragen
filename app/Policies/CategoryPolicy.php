<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Siapa yang boleh lihat menu Kategori?
     */
    public function viewAny(User $user): bool
    {
        // Admin & OPD boleh lihat
        return $user->role === 'admin' || $user->role === 'opd';
    }

    /**
     * Siapa yang boleh lihat detail satu kategori?
     */
    public function view(User $user, Category $category): bool
    {
        return $user->role === 'admin' || $user->role === 'opd';
    }

    /**
     * Siapa yang boleh bikin kategori baru?
     */
    public function create(User $user): bool
    {
        // CUMA ADMIN
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh edit kategori?
     */
    public function update(User $user, Category $category): bool
    {
        // CUMA ADMIN
        return $user->role === 'admin';
    }

    /**
     * Siapa yang boleh hapus kategori?
     */
    public function delete(User $user, Category $category): bool
    {
        // CUMA ADMIN
        return $user->role === 'admin';
    }
}