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
        'client',

        // Anciennes colonnes de la table
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

        // Médias
        'media',
        'image',
        'cover_image',
        'client_logo',
        'gallery',

        // Publication
        'published',
        'featured',
        'status',
        'statut',

        // Nouvelles colonnes dashboard
        'short_description',
        'category',
        'service_type',
        'budget',
        'start_date',
        'end_date',

        // Témoignage
        'testimonial',
        'testimonial_author',

        // SEO / Stats
        'meta_title',
        'meta_description',
        'metrics',

        // Relations éventuelles
        'categorie_id',
        'team_id',
        'user_id',
    ];

    protected $casts = [
        'published' => 'boolean',
        'featured' => 'boolean',
        'budget' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'completion_date' => 'date',
        'media' => 'array',
        'gallery' => 'array',
        'metrics' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all' && $category !== 'tous') {
            return $query->where('category', $category);
        }

        return $query;
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image && str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }

        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function getClientLogoUrlAttribute()
    {
        if ($this->client_logo && str_starts_with($this->client_logo, 'http')) {
            return $this->client_logo;
        }

        return $this->client_logo ? asset('storage/' . $this->client_logo) : null;
    }

    public function getMediaAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public function getGalleryAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public function getMetricsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = new \DateTime($this->start_date);
            $end = new \DateTime($this->end_date);
            $interval = $start->diff($end);

            if ($interval->m > 0) {
                return $interval->m . ' mois';
            }

            if ($interval->d > 0) {
                return $interval->d . ' jours';
            }
        }

        return 'Non spécifié';
    }
}