<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
/*
use Faker\Generator as Faker;
*/
$factory->define(Subject::class, function () {
    return [
        //
        'name' => 'Szerveroldali webprogramozás',
        'description' => 'Tárgy leírása.',
        'code' => 'IK-SOW920',
        'credit' => 3,
        'teacherID' => 1, 
        'published' => 0,
        'studentIDs' => array(),
        'taskIDs' => array(),
    ];
});
