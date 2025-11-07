<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if (($user->role ?? null) === 'admin') {
            return true;
        }
    }

    public function view(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }

    public function delete(User $user, Report $report)
    {
        return $user->id === $report->user_id;
    }
}
