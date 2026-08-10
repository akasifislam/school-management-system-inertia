<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'message', 'type', 'show_popup', 'show_banner', 'is_active', 'start_date', 'end_date'];
    protected $casts    = ['show_popup' => 'boolean', 'show_banner' => 'boolean', 'is_active' => 'boolean', 'start_date' => 'date', 'end_date' => 'date'];

    public function scopeActive($q)
    {
        return $q->where('is_active', true)
            ->where(fn($q) => $q->whereNull('start_date')->orWhere('start_date', '<=', now()))
            ->where(fn($q) => $q->whereNull('end_date')->orWhere('end_date', '>=', now()));
    }
}
