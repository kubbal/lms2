<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasodikFelvonasInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->integer('score');
            $table->dateTimeTz('begin', 0);
            $table->dateTimeTz('end', 0);
            $table->integer('subjectID');
            $table->text('solutionIDs');
            $table->timestamps();
        });

        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->text('solution')->nullable();
            $table->integer('grade')->nullable();
            $table->text('notes')->nullable();
            $table->integer('userID');
            $table->integer('taskID');
            $table->string('filename', 256)->nullable();
            $table->timestamps();
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->text('taskIDs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('solutions');
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('taskIDs');
        });
    }
}
