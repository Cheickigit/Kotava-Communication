<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'extrait',
        'description',
        'image',
        'statut',
        'date_publication',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Scope pour les actualités publiées
    public function scopePublished($query)
    {
        return $query->where('statut', 'publié');
    }
}
