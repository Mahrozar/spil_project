<?php

namespace App\Policies;

use App\Models\RW;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RWPolicy
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

    public function view(User $user, RW $rw)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function create(User $user)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function update(User $user, RW $rw)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function delete(User $user, RW $rw)
    {
        return ($user->role ?? null) === 'admin';
    }
}
