<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'old_status',
        'new_status',
        'changed_by',
        'notes',
    ];

    // Relationships
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    // Accessors
    public function getOldStatusLabelAttribute()
    {
        return Report::getStatusLabels()[$this->old_status] ?? $this->old_status;
    }

    public function getNewStatusLabelAttribute()
    {
        return Report::getStatusLabels()[$this->new_status] ?? $this->new_status;
    }
}