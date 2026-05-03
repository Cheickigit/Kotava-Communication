<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'entreprise',
        'message',
        'status',
        'service',
        'is_read',
        'source',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'nouveau');
    }
}