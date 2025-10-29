<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Scope a query to only include tasks with a specific status.
     */
    public function scopeStatus($query, $status)
    {
        if ($status && in_array($status, ['pendente', 'concluida'])) {
            return $query->where('status', $status);
        }
        
        return $query;
    }

    /**
     * Get the status label in a readable format.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pendente' => 'Pendente',
            'concluida' => 'Concluída',
            default => $this->status,
        };
    }

    /**
     * Get the status badge class for display.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'pendente' => 'warning',
            'concluida' => 'success',
            default => 'secondary',
        };
    }
}


