<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['roll_no', 'name_bn', 'name_en', 'father_name', 'mother_name', 'father_occupation', 'monthly_income', 'dob', 'gender', 'religion', 'birth_cert_no', 'class', 'shift', 'section', 'prev_school', 'prev_class', 'prev_result', 'mobile', 'email', 'address', 'photo', 'status', 'academic_year', 'transfer_note'];
    protected $casts    = ['dob' => 'date'];
}
