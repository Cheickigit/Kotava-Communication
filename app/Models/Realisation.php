<?php

// app/Models/Realisation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'client',
        'sector',
        'country',
        'type',
        'completion_date',
        'summary',
        'description',
        'context',
        'solution',
        'results',
        'client_testimony',
        'media',
        'published',
        'categorie_id',
        'image',
    ];

    protected $casts = [
        'media' => 'array', // Stocke les médias comme un tableau
    ];

    public function getRouteKeyName()
    {
        return 'slug';  // Permet d'utiliser le slug pour l'URL
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id'); // Lien avec la table categories
    }
}
