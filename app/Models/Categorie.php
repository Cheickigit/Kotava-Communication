<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type', // Votre table a ce champ
    ];

    // Si vous voulez ajouter les champs manquants plus tard
    // protected $attributes = [
    //     'color' => '#0e437d',
    //     'description' => '',
    //     'icon' => null,
    // ];

    // Relation avec les réalisations
    public function realisations()
    {
        return $this->hasMany(Realisation::class);
    }

    // Accessor pour la couleur (par défaut basée sur le nom)
    public function getColorAttribute()
    {
        $colors = [
            'branding' => '#0e437d',
            'web-digital' => '#22ae84',
            'social-media' => '#1c978a',
            'video' => '#178e8b',
        ];

        return $colors[$this->slug] ?? '#0e437d';
    }
}
