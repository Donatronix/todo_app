<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_dos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description');
            $table->date('dueDate');
            $table->enum('priority',['low','medium','high']);
            $table->enum('status',['ongoing','completed'])->default('ongoing');
            $table->date('completedDate')->nullable();
            $table->unsignedBigInteger('assigned_by_id');
            $table->foreign('assigned_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('assigned_to_id');
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_dos');
    }
}
