<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormReply extends Model
{
    protected $fillable = [
        'form_id',
        'user_id',
        'subject',
        'message',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];

    // Relaciones
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accesores
    public function getFormattedSentAtAttribute()
    {
        return $this->sent_at->format('d/m/Y H:i');
    }
}
