<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeeqatLocation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_ar',
        'name_ur',
        'description',
        'description_ur',
        'latitude',
        'longitude',
        'for_pilgrims_from',
        'color',
        'icon',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
        'is_active' => 'boolean',
    ];

    // =========================================
    // SCOPES
    // =========================================

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // =========================================
    // RELATIONSHIPS
    // =========================================

    public function distanceLogs(): HasMany
    {
        return $this->hasMany(MeeqatDistanceLog::class, 'nearest_meeqat_id');
    }

    // =========================================
    // ACCESSORS
    // =========================================

    public function getCoordinatesAttribute(): array
    {
        return ['lat' => $this->latitude, 'lng' => $this->longitude];
    }

    public function getGoogleMapsUrlAttribute(): string
    {
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }

    public function getAppleMapsUrlAttribute(): string
    {
        return "https://maps.apple.com/?q={$this->latitude},{$this->longitude}";
    }

    public function getWazeUrlAttribute(): string
    {
        return "https://waze.com/ul?ll={$this->latitude},{$this->longitude}&navigate=yes";
    }

    public function getShortNameAttribute(): string
    {
        return explode('(', $this->name_en)[0]->trim() ?? $this->name_en;
    }

    public function getBgColorClassAttribute(): string
    {
        return match(true) {
            str_contains($this->color, '22c55e') => 'bg-primary-500/20 border-primary-500/30 text-primary-400',
            str_contains($this->color, '3b82f6') => 'bg-blue-500/20 border-blue-500/30 text-blue-400',
            str_contains($this->color, 'f59e0b') => 'bg-gold-500/20 border-gold-500/30 text-gold-400',
            str_contains($this->color, '8b5cf6') => 'bg-purple-500/20 border-purple-500/30 text-purple-400',
            str_contains($this->color, 'ef4444') => 'bg-red-500/20 border-red-500/30 text-red-400',
            default                               => 'bg-dark-700 border-dark-600 text-dark-300',
        };
    }
}