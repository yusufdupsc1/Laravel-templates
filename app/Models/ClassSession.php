<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSession extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'teacher',
        'time',
        'room',
        'status',
    ];
}
