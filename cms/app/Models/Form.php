<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    protected $fillable = [
        'form_type',
        'name',
        'email',
        'phone',
        'message',
        'company',
        'status',
        'additional_fields',
        'ip_address',
        'user_agent',
        'source'
    ];

    protected $casts = [
        'additional_fields' => 'array'
    ];

    protected $attributes = [
        'status' => 'unread'
    ];

    // Relaciones
    public function replies(): HasMany
    {
        return $this->hasMany(FormReply::class);
    }

    // Scopes para filtros comunes
    public function scopeByType($query, $type)
    {
        return $query->where('form_type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    // Mutadores
    public function setAdditionalFieldsAttribute($value)
    {
        $this->attributes['additional_fields'] = is_array($value) ? json_encode($value) : $value;
    }

    // Accesores
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'unread' => 'Sin leer',
            'read' => 'Leído',
            'replied' => 'Respondido',
            'archived' => 'Archivado'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getFormTypeLabelAttribute()
    {
        $labels = [
            'contact' => 'Contacto',
            'lead_converter' => 'Generador de Leads'
        ];

        return $labels[$this->form_type] ?? $this->form_type;
    }
}
