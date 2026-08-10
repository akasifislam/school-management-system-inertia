<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExamResult extends Model
{
    protected $fillable = ['title', 'exam_type', 'year', 'description', 'file'];
}
