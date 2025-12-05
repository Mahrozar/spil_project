<?php

namespace App\Policies;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResidentPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if (($user->role ?? null) === 'admin') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function view(User $user, Resident $resident)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function create(User $user)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function update(User $user, Resident $resident)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function delete(User $user, Resident $resident)
    {
        return ($user->role ?? null) === 'admin';
    }
}
