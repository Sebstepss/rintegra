<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'page_id',
        'content_type',
        'content_data',
        'order'
    ];

    protected $casts = [
        'content_data' => 'array'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
