<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['eiin', 'name_bn', 'name_en', 'village', 'ward', 'city_corp', 'post_office', 'post_code', 'police_station', 'upazila', 'district', 'division', 'phone', 'email', 'website', 'student_count', 'shift', 'type', 'land_area', 'buildings', 'classrooms', 'multimedia_rooms', 'ict_labs', 'science_labs', 'library_rooms', 'has_auditorium', 'has_boundary'];
}
