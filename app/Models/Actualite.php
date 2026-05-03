<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'titre',
        'slug',
        'extrait',
        'description',
        'content',
        'category',
        'image',
        'published',
        'statut',
        'status',
        'date_publication',
        'featured',
        'meta_title',
        'meta_description',
        'user_id',
        'team_id',
    ];

    protected $casts = [
        'published' => 'boolean',
        'featured' => 'boolean',
        'date_publication' => 'datetime',
    ];

    protected $appends = [
        'image_url',
    ];

    public function scopePublished($query)
    {
        return $query
            ->where(function ($q) {
                $q->where('statut', 'publié')
                    ->orWhere('published', true);
            });
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, '/storage/')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getContentAttribute($value): ?string
    {
        return $value ?: $this->description;
    }
}