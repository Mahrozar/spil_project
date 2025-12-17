<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterSubmission extends Model
{
    use HasFactory;

    protected $table = 'letter_submissions';

    protected $fillable = [
        'submission_number',
        'jenis_surat',
        'nama',
        'nik',
        'alamat',
        'keperluan',
        'telepon',
        'email',
        'status',
    ];

    // Allowed statuses
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVE = 'approve';
    public const STATUS_ON_PROGRESS = 'on progres';
    public const STATUS_REJECTED = 'rejected';

    /**
     * Scope a query to only submissions with given status.
     */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Check helpers
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVE;
    }

    public function isInProgress(): bool
    {
        return $this->status === self::STATUS_ON_PROGRESS;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Return list of allowed statuses (useful for dropdowns)
     */
    public static function allowedStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_APPROVE,
            self::STATUS_ON_PROGRESS,
            self::STATUS_REJECTED,
        ];
    }

    /**
     * Return a human-friendly label for the status.
     */
    public static function labelFor(string $status): string
    {
        return match ($status) {
            self::STATUS_APPROVE => 'Disetujui',
            self::STATUS_ON_PROGRESS => 'Sedang Diproses',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Menunggu',
        };
    }

    /**
     * Instance accessor for status label.
     */
    public function statusLabel(): string
    {
        return self::labelFor($this->status ?? self::STATUS_PENDING);
    }

    /**
     * Return tailwind classes for badge based on status.
     */
    public function badgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_APPROVE => 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800',
            self::STATUS_ON_PROGRESS => 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800',
            self::STATUS_REJECTED => 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-rose-100 text-rose-800',
            default => 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800',
        };
    }
}
