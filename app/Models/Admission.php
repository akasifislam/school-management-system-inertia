<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = ['name_bn', 'name_en', 'father_name', 'mother_name', 'father_occupation', 'monthly_income', 'dob', 'gender', 'religion', 'birth_cert_no', 'applying_class', 'prev_school', 'prev_class', 'prev_result', 'mobile', 'email', 'address', 'photo', 'status'];
    protected $casts    = ['dob' => 'date'];
}
