<?php

namespace App\Policies;

use App\Models\Letter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LetterPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if (($user->role ?? null) === 'admin') {
            return true;
        }
    }

    public function view(User $user, Letter $letter)
    {
        return $user->id === $letter->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Letter $letter)
    {
        return $user->id === $letter->user_id;
    }

    public function delete(User $user, Letter $letter)
    {
        return $user->id === $letter->user_id;
    }
}
