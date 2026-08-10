<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['title', 'description', 'file', 'publish_date', 'is_active', 'is_banner'];
    protected $casts    = ['publish_date' => 'date', 'is_active' => 'boolean', 'is_banner' => 'boolean'];
}
