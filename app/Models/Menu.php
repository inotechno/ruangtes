<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    protected $fillable = [
        'is_title',
        'name',
        'icon',
        'route',
        'url',
        'parent_id',
        'order',
        'is_active',
        'roles',
        'permissions',
        'key',
        'badge',
        'badge_color'
    ];

    protected $casts = [
        'roles' => 'array',
        'permissions' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (!$menu->key) {
                $menu->key = Str::slug($menu->name, '_');
            }
        });

        static::updated(function ($menu) {
            // Clear cache ketika menu diupdate
            cache()->forget('menus.all.active');
            cache()->forget('menus.user.*');
        });

        static::deleted(function ($menu) {
            // Clear cache ketika menu dihapus
            cache()->forget('menus.all.active');
            cache()->forget('menus.user.*');
        });
    }

    /**
     * Get parent menu
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get child menus
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function getHasChildrenAttribute(): bool
    {
        return $this->children->isNotEmpty();
    }

    /**
     * Get all permissions from Spatie
     */
    public function getAllPermissionsAttribute()
    {
        return Permission::orderBy('name')->get();
    }

    /**
     * Get available parent menus
     */
    public function getAvailableParentsAttribute()
    {
        return self::whereNull('parent_id')
            ->where('id', '!=', $this->id)
            ->orderBy('name')
            ->get();
    }

    /**
     * Get formatted URL
     */
    public function getFormattedUrlAttribute(): string
    {
        if ($this->route) {
            return route($this->route);
        }

        if ($this->url) {
            return url($this->url);
        }

        return 'javascript:void(0);';
    }

    /**
     * Get status badge
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->is_active
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';
    }

    /**
     * Check if has children
     */
    public function checkHasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Scope untuk menu aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk menu parent
     */
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('route', 'like', "%{$search}%")
            ->orWhere('key', 'like', "%{$search}%");
    }

}
