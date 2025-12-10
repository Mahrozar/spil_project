<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'phone',
        'can_manage_reports',
        'can_assign_reports',
        'assigned_reports_count',
        'completed_reports_count',
        'pending_reports_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'can_manage_reports' => 'boolean',
        'can_assign_reports' => 'boolean',
    ];

    // User type constants
    const TYPE_SUPER_ADMIN = 'super_admin';
    const TYPE_ADMIN = 'admin';
    const TYPE_PETUGAS = 'petugas';

    // Relationships
    public function assignedReports()
    {
        return $this->hasMany(Report::class, 'assigned_to');
    }

    public function pendingReports()
    {
        return $this->hasMany(Report::class, 'assigned_to')
            ->whereIn('status', ['submitted', 'verified', 'in_progress']);
    }

    public function completedReports()
    {
        return $this->hasMany(Report::class, 'assigned_to')
            ->where('status', 'completed');
    }

    public function statusChanges()
    {
        return $this->hasMany(ReportStatusHistory::class, 'changed_by');
    }

    public function comments()
    {
        return $this->hasMany(ReportComment::class);
    }

    // Scopes
 

    public function scopeCanManageReports($query)
    {
        return $query->where('can_manage_reports', true);
    }

    public function scopeCanAssignReports($query)
    {
        return $query->where('can_assign_reports', true);
    }

    // Methods

    // public function isAdmin()
    // {
    //     return $this->user_type === self::TYPE_ADMIN || $this->isSuperAdmin();
    // }

    // public function isPetugas()
    // {
    //     return $this->user_type === self::TYPE_PETUGAS;
    // }

    public function canManageReports()
    {
        return $this->can_manage_reports || $this->isAdmin();
    }

    public function canAssignReports()
    {
        return $this->can_assign_reports || $this->isAdmin();
    }

    public function getCompletionRateAttribute()
    {
        if ($this->assigned_reports_count === 0) {
            return 0;
        }
        
        return round(($this->completed_reports_count / $this->assigned_reports_count) * 100, 1);
    }

    public function getAverageCompletionTimeAttribute()
    {
        $completedReports = $this->completedReports()->get();
        
        if ($completedReports->isEmpty()) {
            return null;
        }
        
        $totalDays = 0;
        foreach ($completedReports as $report) {
            $created = $report->created_at;
            $completed = $report->statusHistory()
                ->where('new_status', Report::STATUS_COMPLETED)
                ->first();
            
            if ($completed) {
                $totalDays += $created->diffInDays($completed->created_at);
            }
        }
        
        return round($totalDays / $completedReports->count(), 1);
    }
}