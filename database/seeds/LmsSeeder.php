<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Subject;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        DB::table('subjects')->delete();
        factory(User::class, 10)->create();
        factory(Subject::class)->create();
    }
}
