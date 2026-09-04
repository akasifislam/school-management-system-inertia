<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = ['title', 'link', 'is_active'];
    
    protected $casts    = ['is_active' => 'boolean'];
}
