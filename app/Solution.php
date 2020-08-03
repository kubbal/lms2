<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    //
    protected $fillable = [
        'solution', 'grade', 'notes', 'userID', 'taskID', 'filename',
    ];
}
