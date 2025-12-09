<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'report_code',
        'title',
        'description',
        'facility_category',
        'facility_type',
        'latitude',
        'longitude',
        'address',
        'dusun',
        'rt',
        'rw',
        'reporter_name',
        'reporter_phone',
        'reporter_email',
        'is_anonymous',
        'status',
        'priority',
        'assigned_to',
        'due_date',
        'ip_address',
        'user_agent',
        'is_public',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_anonymous' => 'boolean',
        'is_public' => 'boolean',
        'due_date' => 'date',
    ];

    protected $appends = ['facility_label', 'status_label', 'priority_label', 'map_url'];

    // Status constants
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_VERIFIED = 'verified';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CLOSED = 'closed';

    // Priority constants
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    // Facility categories with labels
    public static function getFacilityCategories()
    {
        return [
            'jalan_jembatan' => 'Jalan & Jembatan',
            'penerangan_umum' => 'Penerangan Umum',
            'fasilitas_air' => 'Fasilitas Air',
            'fasilitas_publik' => 'Fasilitas Publik',
            'fasilitas_kesehatan' => 'Fasilitas Kesehatan',
            'fasilitas_pendidikan' => 'Fasilitas Pendidikan',
            'lainnya' => 'Lainnya',
        ];
    }

    // Facility types with labels
    public static function getFacilityTypes()
    {
        return [
            'jalan_jembatan' => [
                'jalan_rusak' => 'Jalan Rusak',
                'jalan_berlubang' => 'Jalan Berlubang',
                'jembatan_rusak' => 'Jembatan Rusak',
                'drainase_tersumbat' => 'Drainase Tersumbat',
                'trotoar_rusak' => 'Trotoar Rusak',
            ],
            'penerangan_umum' => [
                'lampu_jalan_mati' => 'Lampu Jalan Mati',
                'lampu_rusak' => 'Lampu Rusak',
                'tiang_lampu_miring' => 'Tiang Lampu Miring',
            ],
            'fasilitas_air' => [
                'keran_umum_rusak' => 'Keran Umum Rusak',
                'pipa_bocor' => 'Pipa Bocor',
                'saluran_air_tersumbat' => 'Saluran Air Tersumbat',
            ],
            'fasilitas_publik' => [
                'pos_kamling_rusak' => 'Pos Kamling Rusak',
                'balai_desa_rusak' => 'Balai Desa Rusak',
                'taman_rusak' => 'Taman Rusak',
                'lapangan_rusak' => 'Lapangan Rusak',
            ],
            'fasilitas_kesehatan' => [
                'puskesdes_rusak' => 'Puskesdes Rusak',
                'posyandu_rusak' => 'Posyandu Rusak',
            ],
            'fasilitas_pendidikan' => [
                'sekolah_rusak' => 'Sekolah Rusak',
                'taman_baca_rusak' => 'Taman Baca Rusak',
            ],
            'lainnya' => [
                'lainnya' => 'Lainnya',
            ],
        ];
    }

    // Status labels
    public static function getStatusLabels()
    {
        return [
            self::STATUS_SUBMITTED => 'Dilaporkan',
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_IN_PROGRESS => 'Dalam Proses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_REJECTED => 'Ditolak',
            self::STATUS_CLOSED => 'Ditutup',
        ];
    }

    // Priority labels
    public static function getPriorityLabels()
    {
        return [
            self::PRIORITY_LOW => 'Rendah',
            self::PRIORITY_MEDIUM => 'Sedang',
            self::PRIORITY_HIGH => 'Tinggi',
            self::PRIORITY_URGENT => 'Darurat',
        ];
    }

    // Priority colors
    public static function getPriorityColors()
    {
        return [
            self::PRIORITY_LOW => 'bg-gray-100 text-gray-800',
            self::PRIORITY_MEDIUM => 'bg-blue-100 text-blue-800',
            self::PRIORITY_HIGH => 'bg-yellow-100 text-yellow-800',
            self::PRIORITY_URGENT => 'bg-red-100 text-red-800',
        ];
    }

    // Status colors
    public static function getStatusColors()
    {
        return [
            self::STATUS_SUBMITTED => 'bg-gray-100 text-gray-800',
            self::STATUS_VERIFIED => 'bg-blue-100 text-blue-800',
            self::STATUS_IN_PROGRESS => 'bg-yellow-100 text-yellow-800',
            self::STATUS_COMPLETED => 'bg-green-100 text-green-800',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
            self::STATUS_CLOSED => 'bg-purple-100 text-purple-800',
        ];
    }

    // Accessors
    public function getFacilityLabelAttribute()
    {
        $types = self::getFacilityTypes();
        return $types[$this->facility_category][$this->facility_type] ?? $this->facility_type;
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusLabels()[$this->status] ?? $this->status;
    }

    public function getPriorityLabelAttribute()
    {
        return self::getPriorityLabels()[$this->priority] ?? $this->priority;
    }

    public function getStatusColorAttribute()
    {
        return self::getStatusColors()[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPriorityColorAttribute()
    {
        return self::getPriorityColors()[$this->priority] ?? 'bg-gray-100 text-gray-800';
    }

    public function getMapUrlAttribute()
    {
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }

    public function getDaysOpenAttribute()
    {
        return $this->created_at->diffInDays(now());
    }

    // Generate report code
    public static function generateReportCode()
    {
        $prefix = 'RPT-CCH';
        $year = date('Y');
        $lastReport = self::where('report_code', 'like', "{$prefix}-{$year}-%")
            ->orderBy('report_code', 'desc')
            ->first();
        
        if ($lastReport) {
            $lastNumber = intval(substr($lastReport->report_code, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        
        return "{$prefix}-{$year}-{$newNumber}";
    }

    // Relationships
    public function photos()
    {
        return $this->hasMany(ReportPhoto::class)->orderBy('order');
    }

    public function beforePhotos()
    {
        return $this->hasMany(ReportPhoto::class)->where('is_before', true);
    }

    public function afterPhotos()
    {
        return $this->hasMany(ReportPhoto::class)->where('is_before', false);
    }

    public function statusHistory()
    {
        return $this->hasMany(ReportStatusHistory::class)->orderBy('created_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(ReportComment::class)->orderBy('created_at');
    }

    public function publicComments()
    {
        return $this->hasMany(ReportComment::class)
            ->where('is_internal', false)
            ->orderBy('created_at');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function changedByUser()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByFacilityCategory($query, $category)
    {
        return $query->where('facility_category', $category);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
            ->whereIn('status', ['submitted', 'verified', 'in_progress']);
    }

    // Business logic methods
    public function changeStatus($newStatus, $userId = null, $notes = null)
    {
        $oldStatus = $this->status;
        
        // Create history record
        $this->statusHistory()->create([
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $userId,
            'notes' => $notes,
        ]);
        
        // Update report status
        $this->status = $newStatus;
        $this->save();
        
        // Update user stats if completed
        if ($newStatus === self::STATUS_COMPLETED && $this->assigned_to) {
            $user = User::find($this->assigned_to);
            if ($user) {
                $user->increment('completed_reports_count');
                $user->decrement('pending_reports_count');
            }
        }
        
        return true;
    }

    public function assignTo($userId, $dueDate = null)
    {
        $oldAssignee = $this->assigned_to;
        
        // Update old assignee stats
        if ($oldAssignee) {
            $oldUser = User::find($oldAssignee);
            if ($oldUser) {
                $oldUser->decrement('pending_reports_count');
                $oldUser->decrement('assigned_reports_count');
            }
        }
        
        // Update new assignee
        $this->assigned_to = $userId;
        $this->due_date = $dueDate;
        $this->save();
        
        // Update new assignee stats
        $newUser = User::find($userId);
        if ($newUser) {
            $newUser->increment('assigned_reports_count');
            $newUser->increment('pending_reports_count');
        }
        
        return true;
    }
}