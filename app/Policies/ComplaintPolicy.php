<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;

class ComplaintPolicy
{
    /**
     * Siapa yang boleh lihat menu Aduan?
     */
    public function viewAny(User $user): bool
    {
        // Admin dan OPD boleh lihat semua
        return $user->role === 'admin' || $user->role === 'opd';
    }

    /**
     * Siapa yang boleh lihat detail aduan?
     */
    public function view(User $user, Complaint $complaint): bool
    {
        return $user->role === 'admin' || $user->role === 'opd';
    }

    /**
     * Siapa yang boleh edit/update status aduan?
     */
    public function update(User $user, Complaint $complaint): bool
    {
        // Admin dan OPD boleh update
        return $user->role === 'admin' || $user->role === 'opd';
    }

    /**
     * Siapa yang boleh hapus aduan?
     */
    public function delete(User $user, Complaint $complaint): bool
    {
        // Cuma Admin yang boleh hapus
        return $user->role === 'admin';
    }
}