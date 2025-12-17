<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image',
        'cover_image',
        'client',
        'client_logo',
        'category', // branding, web, social, video
        'service_type',
        'status', // en_cours, termine, en_attente
        'published',
        'featured',
        'budget',
        'start_date',
        'end_date',
        'testimonial',
        'testimonial_author',
        'gallery', // JSON array d'images
        'metrics', // JSON pour les statistiques du projet
        'team_id', // Si vous utilisez les équipes
    ];

    protected $casts = [
        'published' => 'boolean',
        'featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'gallery' => 'array',
        'metrics' => 'array',
    ];

    // Scope pour les projets publiés
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    // Scope pour les projets en vedette
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Scope par catégorie
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Accessor pour l'URL de l'image
    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Accessor pour la durée du projet
    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = new \DateTime($this->start_date);
            $end = new \DateTime($this->end_date);
            $interval = $start->diff($end);

            if ($interval->m > 0) {
                return $interval->m . ' mois';
            } elseif ($interval->d > 0) {
                return $interval->d . ' jours';
            }
        }

        return 'Non spécifié';
    }
}
