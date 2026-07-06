<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'avatar',
        'country',
        'city',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // =========================================
    // RELATIONSHIPS
    // =========================================

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // =========================================
    // ROLE CHECK HELPERS
    // =========================================

    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function isEditor(): bool
    {
        return $this->role_id === 2;
    }

    public function isPilgrim(): bool
    {
        return $this->role_id === 3;
    }

    public function isAdminOrEditor(): bool
    {
        return in_array($this->role_id, [1, 2]);
    }

    // =========================================
    // PERMISSION CHECK
    // =========================================

    public function hasPermission(string $permissionName): bool
    {
        return $this->role
            ->permissions()
            ->where('name', $permissionName)
            ->exists();
    }

    // =========================================
    // SCOPES
    // =========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role_id', 1);
    }

    // =========================================
    // ACCESSORS
    // =========================================

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return asset('images/default-avatar.png');
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role?->label ?? 'Unknown';
    }

        public function bookmarkedDuas()
    {
        return $this->belongsToMany(Dua::class, 'user_dua_bookmarks', 'user_id', 'dua_id');
    }
}