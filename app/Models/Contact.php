<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['village', 'ward', 'city_corp', 'post_office', 'post_code', 'police_station', 'upazila', 'district', 'division', 'phone', 'email', 'website', 'map_embed'];
}
