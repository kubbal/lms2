<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'score', 'begin', 'end', 'subjectID', 'solutionIDs',
    ];

    protected $casts = [
        'solutionIDs' => 'array',
    ];
}
