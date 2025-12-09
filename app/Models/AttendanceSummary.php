<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceSummary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'grade',
        'present',
        'late',
        'unmarked',
        'locked',
    ];
}
