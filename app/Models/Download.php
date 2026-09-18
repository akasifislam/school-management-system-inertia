<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['title', 'category', 'file', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];
}
