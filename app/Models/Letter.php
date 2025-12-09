<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function labelFor(string $status): string
    {
        return match ($status) {
            'approved' => 'Disetujui',
            'pending' => 'Menunggu',
            'rejected' => 'Ditolak',
            default => ucfirst($status),
        };
    }

    public function statusLabel(): string
    {
        return self::labelFor($this->status ?? 'pending');
    }

    public function badgeClass(): string
    {
        return match ($this->status) {
            'approved' => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800',
            'pending' => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800',
            'rejected' => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800',
            default => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-800',
        };
    }

    /**
     * Allowed statuses for Letter (useful for dropdowns)
     */
    public static function allowedStatuses(): array
    {
        return ['pending', 'approved', 'rejected'];
    }
}
