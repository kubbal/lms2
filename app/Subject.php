<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name', 'description', 'code', 'credit', 'teacherID', 'published', 'studentIDs', 'taskIDs',
    ];

    protected $casts = [
        'published' => 'boolean',
        'studentIDs' => 'array',
        'taskIDs' => 'array',
    ];
}
