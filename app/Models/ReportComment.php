<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'user_id',
        'comment',
        'is_internal',
        'commenter_name',
        'commenter_role',
    ];

    protected $casts = [
        'is_internal' => 'boolean',
    ];

    // Relationships
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getCommenterDisplayNameAttribute()
    {
        if ($this->user) {
            return $this->user->name;
        }
        return $this->commenter_name ?: 'Anonim';
    }

    public function getCommenterRoleLabelAttribute()
    {
        $roles = [
            'masyarakat' => 'Masyarakat',
            'petugas' => 'Petugas',
            'admin' => 'Admin',
            'super_admin' => 'Super Admin',
        ];
        
        if ($this->user) {
            return $roles[$this->user->user_type] ?? 'Pengguna';
        }
        
        return $roles[$this->commenter_role] ?? 'Masyarakat';
    }
}