<?php

namespace App\Policies;

use App\Models\RT;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RTPolicy
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

    public function view(User $user, RT $rt)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function create(User $user)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function update(User $user, RT $rt)
    {
        return ($user->role ?? null) === 'admin';
    }

    public function delete(User $user, RT $rt)
    {
        return ($user->role ?? null) === 'admin';
    }
}
