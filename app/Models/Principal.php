<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $guarded = [];
    protected $casts    = ['joining_date' => 'date'];
}
