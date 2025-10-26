<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_description',
        'status',
        'featured',
        'is_main_page',
        'sort_order',
        'parent_id',
        'pagecontent'
    ];

    protected $casts = [
        'pagecontent' => 'array',
        'featured' => 'boolean',
        'is_main_page' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('order');
    }

    // Parent-child relationships for subpages
    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('sort_order');
    }

    public function publishedChildren()
    {
        return $this->hasMany(Page::class, 'parent_id')
                   ->where('status', 'published')
                   ->orderBy('sort_order');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeMainPages($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
