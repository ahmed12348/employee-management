<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary key
        $table->string('title'); // Task title
        $table->text('description')->nullable(); // Task description
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        $table->foreignId('employee_id')->constrained('users')->onDelete('cascade'); // Assigned employee
        $table->foreignId('manager_id')->constrained('users')->onDelete('cascade'); // Task creator
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
        Schema::dropIfExists('tasks');
    }
}
